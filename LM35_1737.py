import serial
import time
import requests

port = '/dev/tty.usbmodem14101'
baud = 9600

ser = serial.Serial(port, baud, timeout=1)

# default timeout = none
cnt = 0

while True:
    time.sleep(1)
    temp = ser.readline().strip();
    tempstring = str(temp)
    tempstring = temp.decode('utf-8')
    if tempstring > '':
        s = requests.get('https://dweet.io/dweet/for/LM35_1737?temp='+tempstring)
        cnt = cnt + 1
        print(cnt)
        print(tempstring)
# Write your code here :-)
