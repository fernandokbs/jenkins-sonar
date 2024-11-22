pipeline {
  agent any

  stages {
    stage('Vertificar Docker') {
      steps {
        sh 'docker info'
      }
    }

    stage('Send to sonaqube') {
      steps {
        script {
          docker.image('sonarsource/sonar-scanner-cli').inside('--network sonarqube') {
            sh '''
              sonar-scanner
            '''
          }
        }
      }
    }
  }
}