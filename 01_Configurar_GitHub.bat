@echo off
echo ===================================================
echo 1. AUTORIZACAO DO GITHUB
echo ===================================================
echo Por favor, siga as instrucoes na tela.
echo - Escolha "GitHub.com" (aperte ENTER)
echo - Escolha "HTTPS" (aperte ENTER)
echo - Escolha "Y" (aperte ENTER)
echo - Escolha "Login with a web browser" (aperte ENTER)
echo.
echo O navegador vai abrir. Copie o codigo que aparecer
echo aqui na tela e cole no navegador para autorizar.
echo.
"C:\Program Files\GitHub CLI\gh.exe" auth login

echo.
echo ===================================================
echo 2. CONFIGURANDO A PASTA
echo ===================================================
"C:\Program Files\Git\cmd\git.exe" init
"C:\Program Files\Git\cmd\git.exe" remote add origin https://github.com/oliveiratc/oliveiratc.github.io.git
"C:\Program Files\Git\cmd\git.exe" branch -M main
"C:\Program Files\Git\cmd\git.exe" fetch origin
"C:\Program Files\Git\cmd\git.exe" reset origin/main
"C:\Program Files\Git\cmd\git.exe" add .
"C:\Program Files\Git\cmd\git.exe" commit -m "Sincronizando arquivos locais"
"C:\Program Files\Git\cmd\git.exe" push -u origin main
echo.
echo ===================================================
echo TUDO PRONTO! A configuracao foi concluida.
echo Pode fechar esta janela preta e voltar para o chat.
echo ===================================================
pause
