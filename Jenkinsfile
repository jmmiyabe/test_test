pipeline {
    agent any

    environment {
        COMPOSE_FILE = 'docker-compose.yml'
        WWWUSER = '1000'
        WWWGROUP = '1000'
        DB_CONNECTION = 'mysql'
        DB_HOST = 'mysql'
        DB_PORT = '3306'
        DB_DATABASE = 'laravel'
        DB_USERNAME = 'sail'
        DB_PASSWORD = 'password'
    }

    stages {
        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
            }
        }

        stage('Start Sail') {
            steps {
                sh './vendor/bin/sail up -d'
            }
        }

        stage('Unit Test') {
            steps {
                dir('PRIMS') {
                    sh './vendor/bin/sail exec laravel.test php artisan test'
                }
            }
        }

        stage('Integration Test') {
            steps {
                dir('PRIMS') {
                    sh 'curl -f http://localhost || exit 1'
                }
            }
        }

        stage('Create Docker Image') {
            steps {
                sh 'docker build -t prims-app:latest .'
            }
        }

        stage('Commit Jenkinsfile') {
            steps {
                sh '''
                git config user.email "jmmiyabe@student.apc.edu.ph"
                git config user.name "jmmiyabe"
                git add Jenkinsfile
                git commit -m "Add Jenkinsfile" || true
                git push origin HEAD:main
                '''
            }
        }
    }

    post {
        always {
            steps {
                sh './vendor/bin/sail down || true'
            }
        }
    }
}