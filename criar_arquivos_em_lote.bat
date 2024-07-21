@echo off
setlocal enabledelayedexpansion

:: Solicita o diretório onde os arquivos serão criados
set /p directory=Digite o diretório onde os arquivos serão criados:

:: Verifica se o diretório existe, caso contrário, cria o diretório
if not exist "%directory%" (
    mkdir "%directory%"
)

:: Solicita o nome base do arquivo
set /p filename=Digite o nome base do arquivo:

:: Solicita a extensão do arquivo
set /p extension=Digite a extensão do arquivo (sem o ponto):

:: Solicita a quantidade de arquivos a serem criados
set /p count=Digite a quantidade de arquivos a serem criados:

:: Loop para criar os arquivos
for /l %%x in (1, 1, %count%) do (
  echo Este é o arquivo %%x > "%directory%\%filename%%%x.%extension%"
)

echo %count% arquivos criados com sucesso!
pause
