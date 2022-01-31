@echo off

REM **************************************************
REM 2021-10-23 Thet Phyo Wai Sale Order History data transfer from WD
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
REM Sale Order History Transfer From WD Sale Order
REM --------------------------------------------------
php %crmdir%\scripts\Run_SaleOrderHistoryWD.php


REM ==================================================
REM End
REM ==================================================
exit /b 0
