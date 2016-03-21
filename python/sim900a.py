#!/usr/bin/env python  
# coding=utf-8  
import time
import serial

class SIM900A:
# connection
	def __init__(self, port, baud):
		self.port = port
		self.baud = baud
	def Connect(self):
		self.ser = serial.Serial(self.port, self.baud, timeout=5)
		time.sleep(1)
	def Disconnect(self):
		self.ser.close()
# Module function
	def checkModule(self):
		respone = ''
		self.ser.reset_input_buffer()
		self.ser.reset_output_buffer()
		self.ser.write('AT\r\n')
		time.sleep(1)
		while ser.inWaiting() > 0:
			respone += self.ser.read(1)
		if('OK' in respone):
			return 1
		else:
			return 0
	def checkSIM(self):
		respone = ''
		self.ser.reset_input_buffer()
		self.ser.reset_output_buffer()
		self.ser.write('AT+CPIN?' + '\r\n');
		time.sleep(1)
		while ser.inWaiting() > 0:
			respone += self.ser.read(1)
		if('READY' in respone):
			return 1
		else:
			return 0
	def resetDefaultConfig(self):
		respone = ''
		self.ser.reset_input_buffer()
		self.ser.reset_output_buffer()
		self.ser.write('ATZ\r\n');
		time.sleep(1)
		while ser.inWaiting() > 0:
			respone += self.ser.read(1)
		if(respone.find('OK')>0):
			return 1
		else:
			return 0
	def setCommandEcho(self, echoMode):
		respone = ''
		self.ser.reset_input_buffer()
		self.ser.reset_output_buffer()
		if(!echoMode):
			self.ser.write('ATE0\r\n');
		else:
			self.ser.write('ATE1\r\n');
		time.sleep(1)
		while ser.inWaiting() > 0:
			respone += self.ser.read(1)
		if(respone.find('OK')>0):
			return 1
		else:
			return 0	
# function for call
	def enableCallerInfo(self):
		respone = ''
		self.ser.reset_input_buffer()
		self.ser.reset_output_buffer()
		self.ser.write('AT+CLIP=1\r\n');
		time.sleep(1)
		while ser.inWaiting() > 0:
			respone += self.ser.read(1)
		if(respone.find('OK')>0):
			return 1
		else:
			return 0
	def callNumber(self, phonenumber):
		respone = ''
		self.ser.reset_input_buffer()
		self.ser.reset_output_buffer()
		self.ser.write('ATD%s;\r\n'%(phonenumber));
		time.sleep(2)
		while ser.inWaiting() > 0:
			respone += self.ser.read(1)
		if(respone.find('OK')>0):
			if(respone.find('NO DIALTONE')>0):
				return 'NO DIALTONE',''
			elif(respone.find('BUSY')>0):
				return 'BUSY',''
			elif(respone.find('NO CARRIER')>0):
				return 'NO CARRIER',''
			elif(respone.find('NO ANSWER')>0):
				return 'NO ANSWER',''
			elif(respone.find('CUSD')>0):
				return 'USSD',respone
	def callUSSD(self, phonenumber):
		dvrespone = ''
		respone = ''
		self.ser.write('ATD%s;\r\n'%(phonenumber));
		time.sleep(1)
		while ser.inWaiting() > 0:
			dvrespone += self.ser.read(1)
		if(dvrespone.find('OK')>0):
			time.sleep(1)
			while ser.inWaiting() < 0:
			while ser.inWaiting() > 0:
				respone += self.ser.read(1)			
				elif(respone.find('CUSD')>0):
				return 'USSD',respone
	def callUSSD(self, phonenumber):
		stt,res = self.callNumber('*' + phonenumber + '#')
		return res
	def callUSSD(self, phonenumber, code):
		stt,res = self.callNumber('*' + phonenumber + '*' + code + '#')
		return res
	def hangupCall(self):
		respone = ''
		self.ser.write('ATH\r\n');
		time.sleep(1)
		while ser.inWaiting() > 0:
			respone += self.ser.read(1)
		if(respone.find('OK')>0):
			return 1
		else:
			return 0
	def acceptCall(self):
		respone = ''
		self.ser.write('ATA1\r\n');
		time.sleep(1)
		while ser.inWaiting() > 0:
			respone += self.ser.read(1)
		if(respone.find('OK')>0):
			return 1
		else:
			return 0

#function for SMS
	def setSMSTextMode(self, mode):
		respone = ''
		self.ser.write('AT+CMGF==%d\r\n'%(mode));
		time.sleep(1)
		while ser.inWaiting() > 0:
			respone += self.ser.read(1)
		if(respone.find('OK')>0):
			return 1
		else:
			return 0		
	def SendSMS(self, number, content):
#		self.resetDefaultConfig()
		self.setSMSTextMode(1)
		self.ser.write("AT+CMGS=%s\r\n"%(number))
		time.sleep(1)
		self.ser.write(content)
		self.ser.write("\r\n")
		time.sleep(1)
		self.ser.write(chr(26))
		time.sleep(1)
	def readSMS(self):
	