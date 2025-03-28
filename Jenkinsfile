pipeline {
  agent {
    kubernetes {
      cloud 'test-k8s'
      slaveConnectTimeout 1200
      workspaceVolume hostPathWorkspaceVolume(hostPath: "/opt/workspace", readOnly: false)
      yaml '''
apiVersion: v1
kind: Pod
spec:
  containers:
    - args: [\'$(JENKINS_SECRET)\', \'$(JENKINS_NAME)\']
      image: "registry.cn-shanghai.aliyuncs.com/xhchuxing/jenkins:jnlp-agent-docker"
      name: jnlp
      imagePullPolicy: IfNotPresent
      volumeMounts:
        - mountPath: "/etc/localtime"
          name: "localtime"
          readOnly: false  
    - command:
        - "cat"
      env:
        - name: "LANGUAGE"
          value: "en_US:en"
        - name: "LC_ALL"
          value: "en_US.UTF-8"
        - name: "LANG"
          value: "en_US.UTF-8"
      image: "registry.cn-shanghai.aliyuncs.com/xhchuxing/jenkins:maven-3.9.6"
      imagePullPolicy: "IfNotPresent"
      name: "build"
      tty: true
      volumeMounts:
        - mountPath: "/etc/localtime"
          name: "localtime"
          readOnly: false
        - mountPath: "/app"
          name: "cachedir"
          readOnly: false
    - command:
        - "cat"
      env:
        - name: "LANGUAGE"
          value: "en_US:en"
        - name: "LC_ALL"
          value: "en_US.UTF-8"
        - name: "LANG"
          value: "en_US.UTF-8"
      image: "registry.cn-shanghai.aliyuncs.com/xhchuxing/jenkins:kubectl"
      imagePullPolicy: "IfNotPresent"
      name: "kubectl"
      tty: true
      volumeMounts:
        - mountPath: "/etc/localtime"
          name: "localtime"
          readOnly: false
    - command:
        - "cat"
      env:
        - name: "LANGUAGE"
          value: "en_US:en"
        - name: "LC_ALL"
          value: "en_US.UTF-8"
        - name: "LANG"
          value: "en_US.UTF-8"
      image: "registry.cn-shanghai.aliyuncs.com/xhchuxing/jenkins:docker"
      imagePullPolicy: "IfNotPresent"
      name: "docker"
      tty: true
      volumeMounts:
        - mountPath: "/etc/localtime"
          name: "localtime"
          readOnly: false
        - mountPath: "/var/run/docker.sock"
          name: "dockersock"
          readOnly: false
        - mountPath: "/opt"
          name: "dockerfile"
          readOnly: false
  restartPolicy: "Never"
  nodeSelector:
    build: "true"
  securityContext: {}
  volumes:
    - hostPath:
        path: "/var/run/docker.sock"
      name: "dockersock"
    - hostPath:
        path: "/usr/share/zoneinfo/Asia/Shanghai"
      name: "localtime"
    - hostPath:
        path: "/opt/app"
      name: "cachedir"
    - hostPath:
        path: "/opt/dockerfile"
      name: "dockerfile"
'''
    }

  }
  stages {
    stage('Pulling Code') {
      parallel {
        stage('Pulling Code by Jenkins') {
          when {
            expression {
              env.gitBranch == null
            }

          }
          steps {
            git(changelog: true, poll: true, url: "${GITURL}", branch: "${BRANCH}", credentialsId: 'git-key')
            script {
              COMMIT_ID = sh(returnStdout: true, script: "git log -n 1 --pretty=format:'%h'").trim()
              TAG = "${TAG}" + '-' + COMMIT_ID
              println "Current branch is ${BRANCH}, Commit ID is ${COMMIT_ID}, Image TAG is ${TAG}"
            }

          }
        }

        stage('Pulling Code by trigger') {
          when {
            expression {
              env.gitBranch != null
            }

          }
          steps {
            git(changelog: true, poll: true, url: "${GITURL}", branch: "${BRANCH}", credentialsId: 'git-key')
            script {
              COMMIT_ID = sh(returnStdout: true, script: "git log -n 1 --pretty=format:'%h'").trim()
              TAG = "$TAG" + '-' + COMMIT_ID
              println "Current branch is ${BRANCH}, Commit ID is ${COMMIT_ID}, Image TAG is ${TAG}"
            }

          }
        }

      }
    }


    stage('Docker build for creating image') {
      environment {
        ACR_USER = credentials('d0a3cf2e-1d86-4d89-910f-24e0885ddee0')
      }
      steps {
        container(name: 'docker') {
          sh """
        cp -rp /opt/intelligent/dockerfile   ./  
        cp -rp /opt/intelligent/conf   ./          
    ls > test.log
    cat test.log
    
    
                                                                                                                                                                                                                                                                                                                        echo ${ACR_USER_USR} ${ACR_USER_PSW} ${TAG}
                                                                                                                                                                                                                                                                                                                                docker login -u ${ACR_USER_USR} -p ${ACR_USER_PSW}
                                                                                                                                                                                                                                                                                                                                docker build -t ${ACR_ADDRESS}/${REGISTRY_DIR}/${IMAGE_NAME}:${TAG}  .
                                                                                                                                                                                                                                                                               
                                                                                                                                                                                                                                                                                                                                docker push ${ACR_ADDRESS}/${REGISTRY_DIR}/${IMAGE_NAME}:${TAG}
                                                                                                                                                                                                                                                                                                                                """
        }

      }
    }

  }
  environment {
    COMMIT_ID = ''
    ACR_ADDRESS = 'registry.cn-shanghai.aliyuncs.com'
    REGISTRY_DIR = 'xhchuxing'
    IMAGE_NAME = 'kubernetes'
    NAMESPACE = 'kubernetes'
    TAG = 'donut_intelligent_operation_api'
    GITURL = 'https://git.dev.xhchuxing.com/xhchuxing/donut_intelligent_operation_api.git'
  }
  parameters {
    gitParameter(branch: '', branchFilter: 'origin/(.*)', defaultValue: '', description: 'Branch for build and deploy', name: 'BRANCH', quickFilterEnabled: false, selectedValue: 'NONE', sortMode: 'NONE', tagFilter: '*', type: 'PT_BRANCH')
  }
}