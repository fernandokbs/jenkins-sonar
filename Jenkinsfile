pipeline {
  agent any

  environment { 
    SONAR_TOKEN = credentials('Sonar2')
  }

  stages {
    stage('Vertificar Docker') {
      steps {
        sh 'docker info'
      }
    }

    stage('docker sonar') {
      steps {
        withSonarQubeEnv('docker sonar') {
          script {
            docker.image('sonarsource/sonar-scanner-cli').inside('--network ci-network') {
              sh '''
                sonar-scanner \
                  -Dsonar.host.url=http://sonarqube:9000 \
                  -Dsonar.projectKey=my-php-app \
                  -Dsonar.sources=src \
                  -Dsonar.login=$SONAR_TOKEN \
                  -Dsonar.branch.name=${BRANCH_NAME}
              '''
            }
          }
        }
      }
    }

    stage('Deploy') {
      steps {
        script {
          def qg = waitForQualityGate()
          if (qg.status != 'OK') {
            error "PIPELINE ERROR! ${qg.status}"
          }

          if (qg.status == 'OK') {
            error "PIPELINE SUCCESSS! ${qg.status}"
          }
        }
      }
    }
  }
}