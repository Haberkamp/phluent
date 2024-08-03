FROM php:8.2-cli

# Rationale: https://github.com/hadolint/hadolint/wiki/DL4006
SHELL ["/bin/bash", "-eo", "pipefail", "-c"]

# Install system dependencies
# hadolint ignore=DL3008
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libzip-dev \
	&& rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add Composer's global bin directory to PATH
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json /app

# Install project dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application
COPY . /app

# Generate autoload files
RUN composer dump-autoload

# Set the entrypoint to bash
ENTRYPOINT ["/bin/bash"]
