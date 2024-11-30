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
        withSonarQubeEnv('docker sonar') {
          script {
            docker.image('sonarsource/sonar-scanner-cli').inside('--network ci-network') {
              sh '''
                sonar-scanner \
                  -Dsonar.host.url=http://sonarqube:9000 \
                  -Dsonar.projectKey=my-php-app \
                  -Dsonar.sources=src \
                  -Dsonar.branch.name=${BRANCH_NAME} \
                  -Dsonar.login=$SONAR_TOKEN
              '''
            }
          }
        }
      }
    }

    stage('Quality Gate') {
      steps {
        scripts {
          def qg = waitForQualityGate()
          
          if (qg.status != 'OK') {
            error "Pipeline aborted due to Quality Gate failure: ${qg.status}"
          }
        }
      }
    }
  }
}