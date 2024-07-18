import datetime
import os


fileLog = None


def GetDateStamp():
    t = datetime.datetime.now()
    return t.strftime("%x").replace('/', '-') + " " + t.strftime("%X")
    
def Create(fileName):
    global fileLog
    fileLog = open(fileName, "wt")
    print ("Log file created at " + fileName)

def CreateOrganized(folderName):
    if not os.path.exists(folderName):
        os.makedirs(folderName)
        
    Create(folderName + "/" + GetDateStamp() + ".txt")

def AddData(data):
    global fileLog
    fileLog.write(str(data) + ",\n")
    
def Close():
    global fileLog
    fileLog.close()
    print("File saved.")
