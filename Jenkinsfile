pipeline {
  agent any

  tools {
    sonarQube 'Server' // Nombre del scanner configurado en Jenkins
  }

  environment {
    SONAR_AUTH_TOKEN = credentials('qube-test')
  }

  stages {
    stage('Vertificar Docker') {
      steps {
        sh 'docker info'
      }
    }

    stage('Code Analysis') {
      steps {
          withSonarQubeEnv('SonarScanner') {
              sh '''
              sonar-scanner \
                -Dsonar.host.url=http://sonarqube:9000 \
                -Dsonar.projectKey=my-php-app \
                -Dsonar.sources=src \
                -Dsonar.branch.name=${BRANCH_NAME} \
                -Dsonar.token=$SONAR_AUTH_TOKEN
              '''
          }
      }
    }
  }
}