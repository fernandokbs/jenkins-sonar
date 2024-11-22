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
          docker.image('sonarsource/sonar-scanner-cli').inside('--network ci-network') {
            sh '''
              sonar-scanner \
                -Dsonar.host.url=http://sonarqube:9000 \
                -Dsonar.token=squ_ed299290ec49b76b33c24555a89b3a82aadacba6
            '''
          }
        }
      }
    }
  }
}