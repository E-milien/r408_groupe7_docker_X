# Utiliser une image de base avec PHP et Composer préinstallés
FROM composer:latest AS composer

# Définir le répertoire de travail dans le conteneur
WORKDIR /app

# Copier uniquement le fichier composer.json pour installer les dépendances
COPY composer.json composer.lock ./

# Installer les dépendances
RUN composer install --no-scripts --no-autoloader

# Utiliser une image de base avec PHP, Apache et les dépendances installées précédemment
FROM php:8.0-apache

# Activer le module Apache pour le réécriture d'URL
RUN a2enmod rewrite

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copier tous les fichiers du projet Laravel dans le conteneur
COPY --from=composer /app .

# Installer les dépendances (y compris les dépendances de développement)
RUN composer install

# Exposer le port 80
EXPOSE 80

# Commande par défaut pour démarrer Apache
CMD ["apache2-foreground"]