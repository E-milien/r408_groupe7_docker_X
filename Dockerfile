# Utiliser une image de base avec Node.js
FROM node:14-alpine

# Définir le répertoire de travail dans le conteneur
WORKDIR /app

# Copier le fichier package.json et le fichier package-lock.json dans le conteneur
COPY frontend/package*.json ./ 

# Installer les dépendances
RUN npm install

# Copier les fichiers du projet Vue.js dans le conteneur
COPY frontend/ .

# Compiler le projet Vue.js
RUN npm run build

# Exposer le port 80
EXPOSE 80

# Commande par défaut pour démarrer le serveur
CMD ["npm", "run", "serve"]
