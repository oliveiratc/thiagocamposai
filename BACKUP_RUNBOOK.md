# Runbook de Backup e Recuperação — Portfólio

Este documento descreve a arquitetura, operação e procedimentos de contingência do sistema de backup híbrido do portfólio.

---

## 1. Arquitetura do Backup Híbrido (Regra 3-2-1)

O processo adota o padrão de resiliência **3-2-1**:
- **3 Cópias**:
  1. Repositório de trabalho local.
  2. Snapshot local compactado em `.zip` (`backups/`).
  3. Cópias externas em nuvem.
- **2 Mídias/Canais distintos**:
  1. Sistema de arquivos local + Nuvem Pessoal (Google Drive e OneDrive).
  2. Nuvem de controle de versão distribuído (GitHub).
- **1 Cópia fora do ambiente primário (Offsite)**:
  - GitHub Remote (`https://github.com/oliveiratc/thiagocamposai.git`).
  - Google Drive (`Meu Drive (thiago150882@gmail.com)\Backups\Portifolio`).
  - OneDrive (`OneDrive\Backups\Portifolio`).

---

## 2. Componentes e Arquivos

| Arquivo | Descrição |
|---|---|
| `executar_backup.bat` | Script inicializador com 1 clique (executa com bypass de política de execução do PowerShell). |
| `executar_backup.ps1` | Script principal com motor de compactação, detecção de nuvens, checagem Git e retenção. |
| `.gitignore` | Impede que a pasta de snapshots locais (`backups/`) seja enviada para o repositório público do GitHub. |

---

## 3. Como Executar Manualmente (1 Clique)

1. Dê dois cliques em **`executar_backup.bat`**.
2. O script executará as 5 etapas:
   - **[1/5]** Compacta o projeto (código, imagens, metadados e `.git`) gerando `backups/Backup_Portifolio_YYYYMMDD_HHMMSS.zip`.
   - **[2/5]** Copia o arquivo gerado para o Google Drive.
   - **[3/5]** Copia o arquivo gerado para o OneDrive.
   - **[4/5]** Verifica o status do repositório Git e executa `git push` se estiver sincronizado.
   - **[5/5]** Aplica a política de retenção (remove snapshots locais com mais de 30 dias para não lotar o disco).

---

## 4. Como Automatizar no Windows (Agendador de Tarefas)

Para agendar o backup diariamente ou semanalmente:

1. Pressione `Win + R`, digite `taskschd.msc` e aperte `Enter`.
2. No menu lateral direito, clique em **Criar Tarefa Básica...**
3. Defina um nome: `Backup Diario Portfolio Thiago Campos`.
4. Em **Disparador**, selecione **Diariamente** ou **Semanalmente** e configure o horário desejado (ex: `20:00`).
5. Em **Ação**, selecione **Iniciar um programa**:
   - **Programa/script:** `powershell.exe`
   - **Adicione argumentos:** `-NoProfile -ExecutionPolicy Bypass -WindowStyle Hidden -File "C:\Users\thiag\.gemini\antigravity\scratch\Portifolio\executar_backup.ps1"`
   - **Iniciar em:** `C:\Users\thiag\.gemini\antigravity\scratch\Portifolio`
6. Clique em **Avançar** e depois em **Concluir**.

---

## 5. Procedimento de Restauração (Disaster Recovery)

### Cenário A: Recuperar a partir do Snapshot .zip (Local, Google Drive ou OneDrive)
1. Localize o arquivo `Backup_Portifolio_YYYYMMDD_HHMMSS.zip` mais recente em:
   - `backups/` ou
   - `Google Drive\Backups\Portifolio` ou
   - `OneDrive\Backups\Portifolio`.
2. Extraia o conteúdo diretamente para a pasta de destino desejada.
3. Como o diretório `.git` está preservado dentro do `.zip`, todo o histórico e branches do Git voltam intactos.

### Cenário B: Recuperar a partir do GitHub
1. Em qualquer máquina com Git:
   ```bash
   git clone https://github.com/oliveiratc/thiagocamposai.git
   ```
2. O código, os assets e a estrutura completa estarão prontos para uso imediatamente.
