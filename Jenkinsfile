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
                -Dsonar.login=squ_d982519d1594d46d4096a97ff561bf4ecb1bb387
            '''
          }
        }
      }
    }
  }
}