# SPDX-FileCopyrightText: 2021 ladyada for Adafruit Industries
# SPDX-License-Identifier: MIT

import time
import datetime
import sys
import board
import busio
import adafruit_ccs811  #eCO2 & TVOC
import Adafruit_DHT     #Temp & Humidity
import RPi.GPIO as GPIO
import json
import csv              #log data into CPU file
from gpiozero import CPUTemperature #cpuTemp
import blynklib

#Initialize GPIO
GPIO.setwarnings(True)
GPIO.setmode(GPIO.BCM)

#Authenticate & Initialize Blynk
BLYNK_AUTH = 'KSN994YhsCa6D9Oin3M3gN6xxls51R6r'
blynk = blynklib.Blynk(BLYNK_AUTH)

#Blynk
T_CRI_VALUE = 20.0  # 20.0°C
T_CRI_MSG = 'Low TEMP!!!'
T_CRI_COLOR = '#c0392b'

T_COLOR = '#f5b041'
H_COLOR = '#85c1e9'
P_COLOR = '#a2d9ce'
A_COLOR = '#58d68d'
ERR_COLOR = '#444444'

#Blynk Virtual Pins
T_VPIN = 7
H_VPIN = 8
ECO2_VPIN = 9
TVOC_VPIN = 10
M_VPIN = 11
GPIO_DHT22_PIN = 17

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


# Initialize GPIO4 DHT11 Sensor for Humidity & Ambient Temperature data
gpioTempHum = 4
sensor = Adafruit_DHT.DHT11

# Function to get ambient temperature
def get_temp():
	humidity, temperature = Adafruit_DHT.read_retry(sensor, gpioTempHum)
	blynk.set_property(T_VPIN, 'color', T_COLOR)
	blynk.virtual_write(T_VPIN, temperature)
	return temperature

        
# Function to get ambient humidity
def get_humidity():
	humidity, temperature = Adafruit_DHT.read_retry(sensor, gpioTempHum)
	blynk.set_property(H_VPIN, 'color', H_COLOR)
	blynk.virtual_write(H_VPIN, humidity)
	return humidity

    
# Initialize CCS811 Sensor for Air Quality - Equivalent CO2 (eCO2) & Total Volatile Organic Compound (TVOC) data
i2c = board.I2C()  # uses board.SCL and board.SDA
ccs811 = adafruit_ccs811.CCS811(i2c)
# Wait for the sensor to be ready
while not ccs811.data_ready:
    pass

# Function to get equivalent CO2
def get_eCO2():
    eCO2 = str(ccs811.eco2)
    blynk.virtual_write(ECO2_VPIN, eCO2)
    return eCO2

# Function to get Total Volatile Organic Compound
def get_TVOC():
    TVOC = str(ccs811.tvoc)
    blynk.virtual_write(TVOC_VPIN, TVOC)
    return TVOC


#Initialize GPIO for Soil Moisture Sensor - *requires analog-to-digital converter chip [MCP3008] *
gpioMoisture = 21
GPIO.setup(gpioMoisture, GPIO.IN)

# Function to get soil moisture
def get_soilMoisture():
    soilMoisture = GPIO.input(gpioMoisture)
    blynk.virtual_write(M_VPIN, soilMoisture)
    return soilMoisture


#Function for CPU Temp - for relay switch
def get_cpuTemp():
    cpu = CPUTemperature()
    cpuTemp = str(cpu.temperature)
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

# Function for logging accumlated sensor data
def writeToCSV():
    f = open("/home/pi/GreenhouseIOT/test2021-6-8.csv", "a", newline="") 
    rc = csv.writer(f)
    rc.writerow([get_date(), get_time(), get_temp(), get_humidity(), get_eCO2(), get_TVOC(), get_soilMoisture(), get_cpuTemp()])
    f.close()


# Infinite Loop
# Print sensor data to display
while True:
    #Print to Shell
    print("Date: {}, Time: {}, Temperature: {}°C, Humidity: {}%, CO2: {}PPM, TVOC: {}PPB, Moisture: {}, CPU Temp: {}".format(get_date(), get_time(), get_temp(), get_humidity(), get_eCO2(), get_TVOC(), get_soilMoisture(), get_cpuTemp())) 
    
    #Log to CSV file
    writeToCSV()
    
    #Display on Blynk app
    blynk.run()
    
    #Sleep for 5 seconds
    time.sleep(5)
    


GPIO.cleanup()
