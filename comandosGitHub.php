ID  Categoría2	                                Comando         Descripción                                                 Ejemplo de uso
1   Configuración Inicial                       git config	    Configura tu nombre de usuario, email, etc.	                git config --global user.name "Tu Nombre"
2	Iniciar un Proyecto (Opción A: Nuevo)	    git init	    Inicializa un nuevo repositorio local en una carpeta.	    git init
2	Iniciar un Proyecto (Opción B: Existente)	git clone	    Clona (descarga) un repositorio existente desde GitHub.	    git clone [URL_del_repo]
3	Flujo de Trabajo Diario                     git status	    Muestra el estado del repositorio (archivos modificados).	git status
3	Flujo de Trabajo Diario	                    git add	        Agrega archivos al área de preparación (staging).	        git add archivo.txt o git add .
3	Flujo de Trabajo Diario	                    git commit	    Guarda los cambios preparados en el historial local.	    git commit -m "Mensaje del commit"
4	Trabajo con Ramas (Branches)	            git branch	    Lista todas las ramas. Con un nombre, crea una nueva.	    git branch o git branch nueva-rama
4	Trabajo con Ramas (Branches)	            git checkout	Cambia a la rama especificada.	                            git checkout nueva-rama
4	Trabajo con Ramas (Branches)	            git merge	    Fusiona los cambios de una rama en la rama actual.	        git merge nueva-rama (estando en main)
5	Colaboración con GitHub	                    git remote	    Administra las conexiones a repositorios remotos.	        git remote -v (para verlas)
5	Colaboración con GitHub	                    git fetch	    Descarga los cambios del remoto, pero no los fusiona.	    git fetch origin
5	Colaboración con GitHub	                    git pull	    Descarga y fusiona los cambios del remoto.	                git pull origin main
5	Colaboración con GitHub	                    git push	    Sube tus commits locales al repositorio remoto.	            git push origin main
6	Revisar el Historial	                    git log	        Muestra el historial de commits.	                        git log o git log --oneline
6	Revisar el Historial	                    git diff	    Muestra las diferencias entre versiones o commits.	        git diff
7	Herramientas Útiles / Corregir	            git stash	    Guarda temporalmente cambios que no quieres confirmar aún.	git stash (para guardar) y git stash pop (para recuperar)
7	Herramientas Útiles / Corregir	            git reset	    Deshace cambios (¡con cuidado!).	                        git reset --hard HEAD~1 (borra el último commit)
7	Herramientas Útiles / Corregir	            git revert	    Crea un nuevo commit que revierte uno anterior.	            git revert [ID_del_commit]
8	Versionado	                                git tag	        Crea una "etiqueta" para marcar un commit (ej. v1.0).	    git tag -a v1.0 -m "Versión 1.0"
