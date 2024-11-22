# Usamos la imagen lts
FROM jenkins/jenkins:lts

# Usamos la imagen docker:dind y copias el binario a /usr/local/bin
COPY --from=docker:dind /usr/local/bin/docker /usr/local/bin

# Cambiamos de usuario a root para poder agregar al usuario jenkins al grupo root
USER root

RUN apt-get update && apt-get install wget -y

# Download and install SonarScanner
RUN wget https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-4.8.0.2856-linux.zip -O /tmp/sonar-scanner.zip && \
    unzip /tmp/sonar-scanner.zip -d /opt && \
    rm /tmp/sonar-scanner.zip

# Set environment variables
ENV PATH="/opt/sonar-scanner-4.8.0.2856-linux/bin:$PATH"
ENV SONAR_SCANNER_OPTS="-Xms512m -Xmx1024m"

# Agregamos al usuario jenkins al grupo root
RUN usermod -aG root jenkins

# Volvemos a cambiar al usuario jenkins
USER jenkins