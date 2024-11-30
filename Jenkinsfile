pipeline {
  agent any

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
              sonar-scanner \
                -Dsonar.host.url=http://sonarqube:9000 \
                -Dsonar.projectKey=my-php-app \
                -Dsonar.sources=src \
                -Dsonar.login=squ_150b655a5d715f39e293d04ac2ed38ed89c7d42d
            '''
          }
        }
      }
    }
  }
}