from tkinter import *

stats = []
frameLabels = []
frameRoot = None
frame = None
delayedFunc = None

def Close():
    if delayedFunc is not None: frameRoot.after_cancel(delayedFunc)
    frameRoot.destroy()
    
def SetupDisplay(title = "Measurement", onClose = None):
    global frameRoot
    global frame
    global frameLabels
    
    frameRoot = Tk()
    frame = Frame(frameRoot)
    
    frameRoot.title(title)
    if onClose == None: onClose = Close
    frameRoot.protocol("WM_DELETE_WINDOW", onClose)
    
    frame.grid(row = 0, sticky = W)
    frameLabels = []
    
    RepaintDisplay()
    
def MainLoop():
    frameRoot.mainloop()

# Runs a function ONCE after set time, during the running main loop.
def Delayed(timeMillis, func):
    global delayedFunc
    delayedFunc = frameRoot.after(timeMillis, func)

def RepaintDisplay():
    if frameRoot is None or not frameRoot.winfo_exists(): return
    if len(stats) != len(frameLabels): SetupFrameLabels()
    
    for i in range(len(stats)):
        frameLabels[i].config(text=GetStatLabelText(i))
    
    frameRoot.update()
    
def SetupFrameLabels():
    if len(stats) > len(frameLabels):
        for i in range(len(frameLabels), len(stats)):
            CreateFrameLabel(i)
    else:
        for i in range(len(frameLabels), len(stats), -1):
            RemoveFrameLabel(i)
        
    
def CreateFrameLabel(id):
    stat = Label(frame, font = ("Courier", 44))
    stat.grid(row = id, sticky = W, pady = 10)
    frameLabels.append(stat)
    return stat

def RemoveFrameLabel(id = -1):
    frameLabels.pop(id).destroy()
    
def GetStatLabelText(stat):
    stat = GetStatWithNameOrId(stat)
    return str(stat[0]) + ": " + str(stat[2]) + " " + str(stat[1])

def SetStatValue(stat, value):
    stat = GetStatWithNameOrId(stat)
    stat[2] = value
    
def GetStatWithId(statId):
    return stats[statId]

def GetStatWithName(statName):
    return stats[GetStatIdFromName(statName)]

def GetStatIdFromName(statName):
    for i in range(len(stats)):
        if stats[i][0] == statName: return i

def GetStatWithNameOrId(nameOrId):
    iType = type(nameOrId )
    if iType is int: return GetStatWithId(nameOrId)
    if iType is str: return GetStatWithName(nameOrId)

def AddStat(statName, unit = "", value = None):
    newStat = [statName, unit, value]
    stats.append(newStat)
    SetupFrameLabels()
    
def RemoveStat(stat):
    if type(stat) == str: stat = GetStatIdFromName(stat)
    stats.pop(stat)
    SetupFrameLabels()
    
