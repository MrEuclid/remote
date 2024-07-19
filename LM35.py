# Python code - read serial port4

import serial
import time
import requests
from datetime import datetime

port = "/dev/tty.usbmodem14101"
# port = "COM4"
baud = 9600
id = input ("studentID" )
ser = serial.Serial(port, baud, timeout=0)

# default timeout = none
# posts dweets every minute
while True:
    sum = 0;
    cnt = 0 ;
    if ser.in_waiting:
        time.sleep(1)
        while cnt < 20:
            time.sleep(3)
            temp = ser.readline().strip()
            tempstring = temp.decode("utf-8")
            print(tempstring)
            if str(tempstring) > "10":
                sum = sum + float(tempstring)
                cnt = cnt + 1;
                print(cnt,tempstring,sum,sum/cnt)
        tempstr = str(sum/cnt)
        # tempstr = temp.decode("utf-8")
        now = datetime.now()
        hour = now.strftime("%H")
        minute = now.strftime("%M") 
        t = hour +'-'+minute
   
        url = "https://dweet.io/dweet/for/LM35_" + id +"?temp=" + tempstr + "&time="+t
        print(now);
        print(url)
        print(t)
        requests.get(url)
        time.sleep(5)
