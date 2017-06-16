# RoomSecurity

## Introduction

RoomSecurity is a project created as an alternative to commercial "Smart home" and electronic alarm systems. Hardware part was built from cheap electronic components and soldered on prototype PCBs. Software part is a web application built using Symfony and some of my bundles.

## Hardware part

### Main module 

The main module contains an ESP8266 microcontroller (with builtin wifi), ultrasonic distance sensor to detect intrusions, NFC card scanner as a way to enable/disable alarm, 2.4 GHz transmitter to receive data from peripheral modules.

### Peripheral modules

The first peripheral module contains a clone of Arduino Nano v3 (ATMEGA 328P AU microcontroller), another distance sensor, potentiometer to set up alarm treshold parameter, some leds to indicate sensor state. This module should be located near a balcony door or back entrance.

The second peripheral module contains another Nano v3, MQ-5 gas sensor and piezo buzzer to sound an alarm in case of emergency.

Both peripheral modules send data packets to the main module, where they are processed. If a sensor detects alarm state, a request is sent to the server part.

## Server application

The server part is a web application built using Symfony and some of my bundles. Its goal is to control the hardware (enable or disable alarm remotely, check alarm and sensors' state). Authentication of harware modules is secure thanks to simple secret/public keys and sha1 hashing. 


