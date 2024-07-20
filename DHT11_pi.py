# Python code - read serial port4

import serial
import time
import requests
from datetime import datetime

#port = "/dev/tty.usbmodem14101"
#port = "/dev/ttyACM0"
port = "/dev/ttyACM1"
# port = "COM4"
baud = 9600

ser = serial.Serial(port, baud, timeout=0)

# default timeout = none
# posts dweets every minute
while True:
    sum = 0;
    cnt = 0 ;
    if ser.in_waiting:
        time.sleep(1)
        while True:
            time.sleep(1)
            temp = ser.readline().strip()
            tempstring = temp.decode("utf-8")
            # maximum of 2 elements
            try:
                x = tempstring.split(",",1)
                temp = x[0]
                humid = x[1]
                cnt = cnt + 1
                print(cnt,tempstring,temp,humid)
            except IndexError:
                print("Error: Index is out of range.")
            x = tempstring.split(",",1)
           
            now = datetime.now()
            hour = now.strftime("%H")
            minute = now.strftime("%M") 
            t = hour +'-'+minute
            print(temp,humid)
            url = "https://dweet.io/dweet/for/DHT11_1737?temp=" + temp + "&humid=" + humid +"&time="+t
            print(now);
            print(url)
            print(t)
            requests.get(url)
            time.sleep(59)


