@echo off
chcp 65001 >nul
title Backup Portfólio - Thiago Campos
echo ==========================================================
echo   EXECUTANDO ROTINA DE BACKUP HÍBRIDO DO PORTFÓLIO
echo ==========================================================
echo.

powershell -NoProfile -ExecutionPolicy Bypass -File "%~dp0executar_backup.ps1"

echo.
echo Pressione qualquer tecla para encerrar...
pause >nul
