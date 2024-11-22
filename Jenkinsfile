pipeline {
  agent any

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
                -Dsonar.projectKey=tu_proyecto \
                -Dsonar.sources=. \
                -Dsonar.host.url=http://localhost:9000 \
                -Dsonar.login=tu_token
              '''
          }
      }
    }

    stage('Code Analysis') {
  
      when {
        expression { currentBuild.result == null || currentBuild.result == 'SUCCESS' }
      }
 
      steps {
        withSonarQubeEnv('Server') {
          script {
            docker.image('sonarsource/sonar-scanner-cli').inside('--network ci-network') {
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
  }
}