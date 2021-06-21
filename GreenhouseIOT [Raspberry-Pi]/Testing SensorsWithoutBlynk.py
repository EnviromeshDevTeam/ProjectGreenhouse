# SPDX-FileCopyrightText: 2021 ladyada for Adafruit Industries
# SPDX-License-Identifier: MIT

import time
import datetime
import board
import adafruit_ccs811  #eCO2 & TVOC
import Adafruit_DHT     #Temp & Humidity
import RPi.GPIO as GPIO
import json            #log data into JSON file
import csv             #log data into CSV file
from getmac import get_mac_address
from gpiozero import CPUTemperature, OutputDevice  #cpuTemp



#Initialize GPIO
GPIO.setwarnings(True)
GPIO.setmode(GPIO.BCM)



#FUNCTIONS TO USE

# Get Date
def get_date():
    date = datetime.datetime.now().strftime("%Y-%m-%d")
    date = str(date)
    return date

# Get Time
def get_time():
    time = datetime.datetime.now().strftime("%H:%M:%S")
    time = str(time)
    return time

def get_datetime():
    dt = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    dt = str(dt)
    return dt


# Initialize GPIO4 DHT11 Sensor for Humidity & Ambient Temperature data
gpioTempHum = 4
sensor = Adafruit_DHT.DHT11



# Function to get ambient temperature
def get_temp():
	humidity, temperature = Adafruit_DHT.read_retry(sensor, gpioTempHum, retries=5, delay_seconds=1)
	temperature = float(temperature)
	return temperature

# Function to get ambient humidity
def get_humidity():
	humidity, temperature = Adafruit_DHT.read_retry(sensor, gpioTempHum, retries=5, delay_seconds=1)
	humidity = float(humidity)
	return humidity

    
# Initialize CCS811 Sensor for Air Quality - Equivalent CO2 (eCO2) & Total Volatile Organic Compound (TVOC) data
i2c = board.I2C()  # uses board.SCL and board.SDA
ccs811 = adafruit_ccs811.CCS811(i2c)
# Wait for the sensor to be ready
while not ccs811.data_ready:
    pass

# Function to get equivalent CO2
def get_eCO2():
    eCO2 = float(ccs811.eco2)
    return eCO2

# Function to get Total Volatile Organic Compound
def get_TVOC():
    TVOC = float(ccs811.tvoc)
    return TVOC


#Initialize GPIO for Soil Moisture Sensor - *requires analog-to-digital converter chip [MCP3008] *
gpioMoisture = 21
GPIO.setup(gpioMoisture, GPIO.IN)

# Function to get soil moisture
def get_soilMoisture():
    soilMoisture = float(GPIO.input(gpioMoisture))
    return soilMoisture


#Function for CPU Temp - for CPU fan
fan = OutputDevice(26)

def get_cpuTemp():
    cpu = CPUTemperature()
    cpuTemp = float(cpu.temperature)
    return cpuTemp

#Initialize GPIO for Relay Switch
#gpioRelay = 22
#GPIO.setmode(GPIO.BCM)
#GPIO.setup(gpioRelay, GPIO.OUT)

#Turn relay on
def switch_on(pin):
    GPIO.output(pin, GPIO.HIGH)

#Turn relay off
def switch_off(pin):
    GPIO.output(pin, GPIO.LOW)
    
    
# [OPTIONAL] Brightness/Light Sensor - *requires analog-to-digital converter chip [MCP3008] *

#Get MAC address
#def get_MAC_address():
#    eth_mac = get_mac_address()
#    return eth_mac

# Function for logging accumlated sensor data
def writeToJSON():
    f = open("/home/pi/GreenhouseIOT/test2021-6-21.json", "a", newline="\n") 
    tojson = {"device_id":1,"category":" ","data":0}
    alldata = [get_datetime(), get_mac_address(), get_temp(), get_humidity(),get_eCO2(),get_TVOC(), get_soilMoisture(), get_cpuTemp()]
    #get_date() get_time()
    #"date","time"
    
    hardcodecat = ["dateTime","MAC address" "temp","humidity","eCO2","TVOC","soilMoist","cpuTemp"]
    jsonlist = []
    index = 0
    
    for item in len(alldata):
        newdict= {}
        newdict["device_id"]= 1
        newdict["category"]= hardcodecat[index]
        newdict["data"]= item
        jsonlist.append(newdict)
        index += 1
        if len(alldata) == index:
            break
        
    f.write(json.dumps(jsonlist))   
    #rc = csv.writer(f)
    #rc.writerow([get_date(), get_time(), get_mac_address(), get_temp(), get_humidity(), get_eCO2(), get_TVOC(), get_soilMoisture(), get_cpuTemp()])
    f.close()


# Infinite Loop
# Print sensor data to display
while True:
    #Display on Shell
    print("Date: {}, Time: {}, MAC: {}, Temp.: {}°C, Humidity: {}%, CO2: {}PPM, TVOC: {}PPB, Moisture: {}, CPU Temp: {}".format(get_date(), get_time(), get_mac_address(), get_temp(), get_humidity(), get_eCO2(), get_TVOC(), get_soilMoisture(), get_cpuTemp())) 
    
    #Write to JSON file
    writeToJSON()
    
    #Control CPU fan
    if get_cpuTemp() >= 42:
        fan.on()
    else:
        fan.off()
    
    time.sleep(20)
    



GPIO.cleanup()
