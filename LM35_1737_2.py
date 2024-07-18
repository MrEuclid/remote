# Python code - read serial port4

import serial
import time
import requests
from datetime import datetime

port = "/dev/tty.usbmodem14101"
# port = "COM4"
baud = 9600

ser = serial.Serial(port, baud, timeout=0)

# default timeout = none
# posts dweets every minute
while True:
    if ser.in_waiting:
        time.sleep(1)
        temp = ser.readline().strip()
        tempstring = str(temp)
        tempstring = temp.decode("utf-8")
        now = datetime.now()
        hour = now.strftime("%H")
        minute = now.strftime("%M") 
        t = hour +'-'+minute
        url = "https://dweet.io/dweet/for/LM35_1737?temp=" + tempstring + "&time="+t
        print(now);
        print(url)
        print(t)
        time.sleep(59)
