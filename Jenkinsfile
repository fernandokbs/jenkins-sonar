pipeline {
  agent any

  environment {
    SONAR_TOKEN = credentials('Sonar')
  }

  stages {
    stage('Vertificar Docker') {
      steps {
        sh 'docker info'
      }
    }

    stage('Sonarqube') {
      steps {
        script {
          docker.image('sonarsource/sonar-scanner-cli').inside('--network ci-network') {
            sh '''
              sonar-scanner 
            '''
          }
        }
      }
    }
  }
}