import face_recognition
import cv2
import os, os.path
import math
import shutil
import mysql.connector
import time
import multiprocessing
from moviepy.video.io.ffmpeg_tools import ffmpeg_extract_subclip




def Processing(myresult):
    
    #Initializing Face Cascade For FD
    face_cascade = cv2.CascadeClassifier('./resources/haarcascade_frontalface_default.xml')
    #Checking Folders    
    
    if(os.path.exists("Output/Process-"+str(os.getpid()))):
        shutil.rmtree("Output/Process-"+str(os.getpid()))
        
    try:
        if not os.path.exists("Output/Process-"+str(os.getpid())):
            os.makedirs("Output/Process-"+str(os.getpid()))
    except OSError:
        print ('Error: Creating directory of Process')
    try:
        if not os.path.exists("Database"):
            os.makedirs("Database")
    except OSError:
        print ('Error: Creating directory of Process')
    try:
        if not os.path.exists("Database/Clips"):
            os.makedirs("Database/Clips")
    except OSError:
        print ('Error: Creating directory of Process')
    #Frames
    try:
        if not os.path.exists('./Output/Process-'+str(os.getpid())+'/Frames'):
            os.makedirs('./Output/Process-'+str(os.getpid())+'/Frames')
    except OSError:
        print ('Error: Creating directory of data')
    #Faces
    try:
        if not os.path.exists('./Output/Process-'+str(os.getpid())+'/Faces'):
            os.makedirs('./Output/Process-'+str(os.getpid())+'/Faces')
        if not os.path.exists('./Output/Process-'+str(os.getpid())+'/Faces/MetaData'):
            os.makedirs('./Output/Process-'+str(os.getpid())+'/Faces/MetaData')
    except OSError:
        print ('Error: Creating directory of Faces')
    #Recognized
    try:
        if not os.path.exists('./Output/Process-'+str(os.getpid())+'/Recognized'):
            os.makedirs('./Output/Process-'+str(os.getpid())+'/Recognized')
    except OSError:
        print ('Error: Creating directory of Recognized')
    
    #PROCESSING
    mydb = mysql.connector.connect(
      host="localhost",
      user="root",
      passwd="",
      database="rtfd"
    )
    mycursor = mydb.cursor()
        
    
    option="4"    
    if(option == '1' or option == '4'):
        #video = input("Enter video name to split: ")
        video=myresult[1]
        cap = cv2.VideoCapture(video)
        framerate = cap.get(5)
        currentFrame = 1
        
        print("--------- Splitting Frames from Video ---------")
        while(True):
            ret, frame = cap.read()
            frameId = cap.get(1)
        
            if (frameId % math.floor(framerate) == 1):
                name = './Output/Process-'+str(os.getpid())+'/Frames/' + str(currentFrame) + '.jpg'
                print ('Creating frame: ' + name)
                cv2.imwrite(name, frame)
                currentFrame += 1
                    
            if not ret: break  
        
        print("--------- Splitting Ended ---------")
        cap.release()
        cv2.destroyAllWindows()
    
    if(option == '2' or option == '4'):
        path='./Output/Process-'+str(os.getpid())+'/Frames'
        faceID = 1;
        print("--------- Detecting Faces from Frames ---------")
        for filename in os.listdir(path):
            cap = cv2.imread(path+'\\'+filename)
            gray = cv2.cvtColor(cap, cv2.COLOR_BGR2GRAY)
            faces = face_cascade.detectMultiScale(gray, 1.3, 9)
            for (x,y,w,h) in faces:
                cv2.rectangle(cap, (x,y), (x+w, y+h), (255,0,0),2)
                roi_gray = gray[y:y+h, x:x+w]
                roi_color = cap[y:y+h, x:x+w]
                resized_image = cv2.resize(roi_color, (300, 300))
                cv2.imwrite('./Output/Process-'+str(os.getpid())+'/Faces/'+ str(faceID) + '.jpg', resized_image)
                file = open('./Output/Process-'+str(os.getpid())+'/Faces/MetaData/' + str(faceID) + '.txt','w')
                newstr = filename.replace(".jpg", "")
                print ('Creating Face Number: ' + str(faceID) + " On Frame Number: " + newstr)
                file.write(newstr)
                file.close() 
                faceID+=1    
            #cv2.imshow('img',cap)
            #k = cv2.waitKey(14) & 0xff == ord("q")
        print("--------- Face Detection Ended ---------")
        cv2.destroyAllWindows()
    
    if(option == '3' or option == '4'):
        known_face_encodings = []
        known_face_names = []
            
        path = './Input/Culprits/'
        
        mycursor = mydb.cursor()
        mycursor.execute("SELECT Culprit_ID, Path FROM `culprit_pictures`")
        culprits = mycursor.fetchall()
        
        for filename in culprits:
            #filename.replace(".jpg","")
            image = face_recognition.load_image_file(str(filename[1]).replace("RTFD\I","I"))
            face_encoding = face_recognition.face_encodings(image)[0]
            known_face_encodings.append(face_encoding)
            known_face_names.append(str(filename[0]))
        
        face_locations = []
        face_encodings = []
        face_names = []
        process_this_frame = True
        
        path='./Output/Process-'+str(os.getpid())+'/Faces'
        print("--------- Recognizing Faces from Detected Faces from Frames ---------")
        for filename in os.listdir(path):
            if(".jpg" in filename):
                cap = cv2.imread(path+'\\'+filename)
                small_frame = cv2.resize(cap, (0, 0), fx=1, fy=1)
                rgb_small_frame = small_frame[:, :, ::-1]
                name = "Unknown"
                if process_this_frame:
                    face_locations = face_recognition.face_locations(rgb_small_frame)
                    face_encodings = face_recognition.face_encodings(rgb_small_frame, face_locations)
                    face_names = []
                    for face_encoding in face_encodings:
                        matches = face_recognition.compare_faces(known_face_encodings, face_encoding, 0.5)
                        if True in matches:
                            first_match_index = matches.index(True)
                            name = known_face_names[first_match_index]
                            
                            file = open('./Output/Process-'+str(os.getpid())+'/Faces/MetaData/'+filename.replace(".jpg", "") + ".txt", 'r') 
                            frameNo = int(file.read())
                            minute = int(frameNo/60)
                            seconds = (frameNo%60)
                            timeVid = str(minute) + ':' + str(seconds)
                            
                            try:
                                if not os.path.exists('./Output/Process-'+str(os.getpid())+'/Recognized/'+name):
                                    os.makedirs('./Output/Process-'+str(os.getpid())+'/Recognized/'+name)
                            except OSError:
                                print ('Error: Creating directory of data')
                            
                            sql = "SELECT * FROM `tracking` WHERE Culprit_ID = " + str(name) + " and Video_ID = " + str(myresult[0]) + " and Frame_ID = "+ str(frameNo)
                            mycursor.execute(sql)
                            myresult1 = mycursor.fetchone()
                            if not (myresult1):
                                if (len(myresult) < 3):
                                    sql = "INSERT INTO tracking (Culprit_ID, VidTime, Video_ID, Frame_ID, User_vid) VALUES (%s, %s, %s, %s, 0)"
                                    val = (name, timeVid, myresult[0], frameNo)
                                    mycursor.execute(sql, val)
                                    mydb.commit()
                                else:
                                    sql = "INSERT INTO tracking (Culprit_ID, VidTime, Video_ID, Frame_ID, User_vid) VALUES (%s, %s, %s, %s, 1)"
                                    val = (name, timeVid, myresult[0], frameNo)
                                    mycursor.execute(sql, val)
                                    mydb.commit()
                                if (len(myresult) < 3):  
                                    sql = "SELECT Track_ID FROM `tracking` WHERE Culprit_ID = " + str(name) + " and Video_ID = " + str(myresult[0]) + " and Frame_ID = "+ str(frameNo) + " and User_Vid = 0"
                                else:
                                    sql = "SELECT Track_ID FROM `tracking` WHERE Culprit_ID = " + str(name) + " and Video_ID = " + str(myresult[0]) + " and Frame_ID = "+ str(frameNo) + " and User_Vid = 1"
                                mycursor.execute(sql)
                                myresult1 = mycursor.fetchone()
                                ffmpeg_extract_subclip(video, frameNo-10 if frameNo>10 else 0, frameNo+10, targetname="Database/Clips/Track-"+str(myresult1[0])+".mp4")
                                sql = "INSERT INTO `track_video` (`Track_ID`, `path`) VALUES (%s, %s)"
                                val = (myresult1[0], "RTFD/Database/Clips/Track-"+str(myresult1[0])+".mp4")
                                mycursor.execute(sql, val)
                                mydb.commit()
                                print(mycursor.rowcount, "TrackVideo Record inserted.")
                            
                            print ('Creating timestamp image of Suspect: ' + name + " from Image: " + filename + '...')
                            file = open('./Output/Process-'+str(os.getpid())+'/Recognized/' + name + '/metadata.txt' ,'a')
                            file.write("[" + timeVid + ']\t' + video + "\n" )
                            file.close()
                                
                        face_names.append(name)
                        
                for (top, right, bottom, left), name in zip(face_locations, face_names):
                    if (name=="Unknown"):
                         cv2.rectangle(cap, (left, top), (right, bottom), (0, 255, 0), 2)
                    else:
                        cv2.rectangle(cap, (left, top), (right, bottom), (0, 0, 255), 2)
                    # Draw a label with a name below the face
                    if (name=="Unknown"):
                        cv2.rectangle(cap, (left, bottom - 35), (right, bottom), (0, 255, 0), cv2.FILLED)
                    else:
                        cv2.rectangle(cap, (left, bottom - 35), (right, bottom), (0, 0, 255), cv2.FILLED)
                    font = cv2.FONT_HERSHEY_DUPLEX
                    if (name=="Unknown"):
                        cv2.putText(cap, name, (left + 6, bottom - 6), font, 1.0, (255, 255, 255), 1)
                    else:
                        cv2.putText(cap, name, (left + 6, bottom - 6), font, 1.0, (255, 255, 255), 1)
                        cv2.putText(cap, timeVid, (left + 6, bottom - 50), font, 1.0, (255, 255, 255), 1)
                if(name != "Unknown"):
                    cv2.imwrite('./Output/Process-'+str(os.getpid())+'/Recognized/'+ name + '/' + filename, cap)
                #cv2.imshow('img',cap)
                k = cv2.waitKey(1) & 0xff == ord("q")
        
        print("--------- Recognition Ended ---------")
        
        if (len(myresult) < 3):
            sql = "UPDATE `videos` SET `P_Check` = 1 WHERE `videos`.`Video_ID` = " + str(myresult[0])
            mycursor.execute(sql)
            mydb.commit()
        else:
            sql = "UPDATE `user_videos` SET `P_Check` = '1' WHERE `user_videos`.`Video_id` = " + str(myresult[0])
            mycursor.execute(sql)
            mydb.commit()
        print(mycursor.rowcount, "record(s) affected")
        
        cv2.destroyAllWindows()
    
    return os.getpid()
        
if __name__ == "__main__":
    if(os.path.exists("Output")):
        shutil.rmtree("Output")
    
    try:
        if not os.path.exists('Output'):
            os.makedirs('Output')
    except OSError:
        print ('Error: Creating directory of Output')
        
    while True:
        mydb = mysql.connector.connect(
          host="localhost",
          user="root",
          passwd="",
          database="rtfd"
        )
        mycursor = mydb.cursor()
        mycursor.execute("SELECT Video_ID, Path FROM `videos` WHERE P_CHECK = 0")
        myresult = mycursor.fetchall()
        mycursor.execute("SELECT Video_ID, Path, A_Check FROM `user_videos` WHERE P_CHECK = 0")
        myresult += mycursor.fetchall()
        print(myresult)
        if myresult:
            p = multiprocessing.Pool()
            result = p.map(Processing, myresult)
            print (result)
            p.close()
            p.join()
        
        time.sleep(5)