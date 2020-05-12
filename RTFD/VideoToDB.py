from watchdog.observers import Observer
from watchdog.events import FileSystemEventHandler
import time
import mysql.connector
import re
import datetime

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="rtfd"
)

class ExampleHandler(FileSystemEventHandler):
    def on_created(self, event):
        m = re.search("Camera(.+?)", event.src_path)
        print ("Got event for file %s" % event.src_path)
        if m:
            found = m.group(1)

            mycursor = mydb.cursor()
            sql = "INSERT INTO videos (Camera_ID,P_Check,TimeStamp,Path) VALUES (%s, %s, %s, %s)"
            val = (found,0,datetime.datetime.now(),event.src_path)
            mycursor.execute(sql, val)
            mydb.commit()
            print(mycursor.rowcount, "record inserted.")

mycursor = mydb.cursor()
mycursor.execute("SELECT name FROM `surveillance_camera`")
myresult = mycursor.fetchall()

count=0
observer = []
event_handler = []

for x in myresult:
	print(count)
	observer.append(Observer())
	event_handler.append(ExampleHandler())
	observer[count].schedule(event_handler[count], path='Input/Videos/%s' % x[0])
	observer[count].start()
	count+=1
	
try:
    while True:
        time.sleep(1)
except KeyboardInterrupt:
	for x in observer:
		x.stop()
		
for x in observer:
	x.join()