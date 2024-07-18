import matplotlib
import numpy
from time import sleep
import DataLog as Log
import realtimeDataDisplay as Display
import sys


# 

def Close():
   Log.Close()
   Display.Close()

def Init():
    Log.CreateOrganized("TempHumid Log")

    Display.AddStat("Temperature", "*C")
    Display.AddStat("Humidity", "%")
   # Display.SetupDisplay(onClose = Close)


Init()
#Display.Delayed(1000, Update)
# Display.MainLoop()

print("Exit loop")


