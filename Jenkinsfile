pipeline {
  agent { label 'agente1' }

  stages {
    stage('Vertificar Docker') {
      steps {
        sh 'docker info'
      }
    }
  }
}