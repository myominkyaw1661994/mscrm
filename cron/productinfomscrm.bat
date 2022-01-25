@echo off

REM **************************************************
REM 2021-10-18 Thet Phyo Wai Product Info data transfer from MSCRM
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
REM Product Info Transfer From MSCRM Product
REM --------------------------------------------------
php %crmdir%\scripts\Run_ProductInfoMSCRM.php


REM ==================================================
REM End
REM ==================================================
exit /b 0
