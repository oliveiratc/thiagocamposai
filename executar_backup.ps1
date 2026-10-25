[CmdletBinding()]
param (
    [int]$RetencaoDias = 30
)

$ErrorActionPreference = "Stop"
$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $ScriptDir

$Timestamp = Get-Date -Format "yyyyMMdd_HHmmss"
$BackupFileName = "Backup_Portifolio_$Timestamp.zip"

$LocalBackupDir = Join-Path $ScriptDir "backups"
if (-not (Test-Path $LocalBackupDir)) {
    New-Item -ItemType Directory -Path $LocalBackupDir | Out-Null
}

$LocalZipPath = Join-Path $LocalBackupDir $BackupFileName

Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host "  INICIANDO PROCESSO DE BACKUP HIBRIDO - PORTFOLIO" -ForegroundColor Cyan
Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host "[1/5] Preparando snapshot local em: $LocalZipPath" -ForegroundColor Yellow

$ItemsToBackup = Get-ChildItem -Path $ScriptDir -Force | Where-Object {
    $_.Name -ne "backups" -and $_.Name -ne "node_modules" -and $_.Name -notlike "*.tmp"
}

try {
    Compress-Archive -Path $ItemsToBackup.FullName -DestinationPath $LocalZipPath -CompressionLevel Optimal
    $ZipSizeMB = [Math]::Round(((Get-Item $LocalZipPath).Length / 1MB), 2)
    Write-Host "  -> Snapshot local criado com sucesso! Tamanho: $ZipSizeMB MB" -ForegroundColor Green
} catch {
    Write-Error "Falha ao gerar o arquivo compactado: $_"
}

$GoogleDriveDir = Join-Path $env:USERPROFILE "Meu Drive (thiago150882@gmail.com)\Backups\Portifolio"
if (Test-Path (Join-Path $env:USERPROFILE "Meu Drive (thiago150882@gmail.com)")) {
    Write-Host "[2/5] Sincronizando com Google Drive..." -ForegroundColor Yellow
    if (-not (Test-Path $GoogleDriveDir)) {
        New-Item -ItemType Directory -Path $GoogleDriveDir -Force | Out-Null
    }
    Copy-Item -Path $LocalZipPath -Destination (Join-Path $GoogleDriveDir $BackupFileName) -Force
    Write-Host "  -> Copiado com sucesso para o Google Drive!" -ForegroundColor Green
} else {
    Write-Host "[2/5] Google Drive nao detectado. Etapa ignorada." -ForegroundColor DarkGray
}

$OneDriveDir = Join-Path $env:USERPROFILE "OneDrive\Backups\Portifolio"
if (Test-Path (Join-Path $env:USERPROFILE "OneDrive")) {
    Write-Host "[3/5] Sincronizando com OneDrive..." -ForegroundColor Yellow
    if (-not (Test-Path $OneDriveDir)) {
        New-Item -ItemType Directory -Path $OneDriveDir -Force | Out-Null
    }
    Copy-Item -Path $LocalZipPath -Destination (Join-Path $OneDriveDir $BackupFileName) -Force
    Write-Host "  -> Copiado com sucesso para o OneDrive!" -ForegroundColor Green
} else {
    Write-Host "[3/5] OneDrive nao detectado. Etapa ignorada." -ForegroundColor DarkGray
}

Write-Host "[4/5] Verificando sincronizacao com repositorio remoto Git (GitHub)..." -ForegroundColor Yellow
try {
    $GitStatus = git status --porcelain
    if ([string]::IsNullOrWhiteSpace($GitStatus)) {
        git push origin main 2>$null
        Write-Host "  -> Repositorio remoto no GitHub sincronizado e atualizado." -ForegroundColor Green
    } else {
        Write-Host "  -> Aviso: Existem alteracoes locais nao commitadas. O snapshot em zip contem esses arquivos." -ForegroundColor DarkYellow
    }
} catch {
    Write-Host "  -> Nota: Nao foi possivel comunicar com o GitHub no momento." -ForegroundColor DarkYellow
}

Write-Host "[5/5] Aplicando politica de retencao ($RetencaoDias dias)..." -ForegroundColor Yellow
$CorteData = (Get-Date).AddDays(-$RetencaoDias)
Get-ChildItem -Path $LocalBackupDir -Filter "Backup_Portifolio_*.zip" | Where-Object { $_.CreationTime -lt $CorteData } | ForEach-Object {
    Remove-Item $_.FullName -Force
    Write-Host "  -> Removido arquivo antigo expirado: $($_.Name)" -ForegroundColor DarkGray
}

Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host "  BACKUP CONCLUIDO COM SUCESSO!" -ForegroundColor Green
Write-Host "==========================================================" -ForegroundColor Cyan
