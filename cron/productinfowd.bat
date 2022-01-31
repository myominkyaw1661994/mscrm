@echo off

REM **************************************************
REM 2021-10-18 Thet Phyo Wai Product Info data transfer from WD
REM **************************************************

cd %~dp0
cd ..\

REM Enabling deferred environment variables
setlocal ENABLEDELAYEDEXPANSION

set crmdir=%CD%

REM **************************************************
REM
REM Process
REM
REM **************************************************
REM --------------------------------------------------
REM Product Info Transfer From WD Product
REM --------------------------------------------------
php %crmdir%\scripts\Run_ProductInfoWD.php


REM ==================================================
REM End
REM ==================================================
exit /b 0
