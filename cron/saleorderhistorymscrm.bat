@echo off

REM **************************************************
REM 2021-10-22 Thet Phyo Wai Sale Order History data transfer from MSCRM
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
REM Sales Order History Transfer From MSCRM Sales Orders
REM --------------------------------------------------
php %crmdir%\scripts\Run_SalesOrderHistoryMSCRM.php


REM ==================================================
REM End
REM ==================================================
exit /b 0
