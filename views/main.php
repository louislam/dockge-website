<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dockge</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Self-hosted - Docker compose.yaml - Stack-oriented Manager " />
    <link rel="icon" type="image/svg+xml" href="/icon.svg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/prism.css?v=3" />
    <link rel="stylesheet" type="text/css" href="/main.css?v=3" />
</head>

<body>
<div id="app">
    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-5">
                <div class="mt-3 p-1">
                    <img src="/icon.svg" alt="Dockge" class="logo mt-3 mb-3" />

                    <h1>Dockge</h1>

                    <div class="mb-3">
                        Self-hosted - Docker compose.yaml - Stack-oriented Manager
                    </div>

                    <div class="flex mb-3">
                        <a class="btn btn-primary" :href="downloadPath">Download</a>
                        <a class="btn btn-primary" href="https://github.com/louislam/dockge">GitHub</a>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Stacks Directory</span>
                        </div>
                        <input type="text" v-model="stacksPath" class="form-control" placeholder="Stacks Directory" />
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Port</span>
                        </div>
                        <input type="text" v-model="port" class="form-control" placeholder="Port" />
                    </div>

                    <h2 class="my-4">compose.yaml</h2>

                    <div class="compose-yaml">
                        <pre class="language-yaml"><code v-html="composeYAMLHighlighted"></code></pre>
                    </div>

                    <h2 class="my-4">Installation</h2>

                    <div class="compose-yaml">
                        <pre class="language-yaml">
# Create directories that store your stacks and store Dockge's stack
mkdir -p /opt/stacks /opt/dockge
cd /opt/dockge

# Download your compose.yaml
curl {{ downloadPath }} --output compose.yaml

# Start the Server
docker compose up -d

# If you are using docker-compose V1 or Podman
# docker-compose up -d
                        </pre>
                    </div>


                </div>
            </div>
            <div class="col p-5">
                <img class="mt-5 screenshot" src="/screenshot.png" alt="screenshot" />
            </div>
        </div>
    </div>
</div>

<script src="/prism.js" data-manual></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.9/vue.global.prod.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    const { createApp, ref } = Vue
    createApp({
        data() {
            return {
                port: 5001,
                stacksPath: "/opt/stacks",
            }
        },
        computed: {
            downloadPath() {
                let url = new URL(location.protocol + "//" + location.host + "/compose.yaml");
                url.searchParams.append("port", this.portFinal);
                url.searchParams.append("stacksPath", this.stacksPathFinal);
                return url.toString();
            },
            stacksPathFinal() {
                if (!this.stacksPath) {
                    return "/opt/stacks";
                } else {
                    return this.stacksPath;
                }
            },
            portFinal() {
                if (!this.port) {
                    return 5001;
                } else {
                    return this.port;
                }
            },
            composeYAML() {
                return `version: "3.8"
services:
  dockge:
    image: louislam/dockge:1
    restart: unless-stopped
    ports:
      - ${this.portFinal}:5001
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
      - ./data:/app/data
      # ⚠️ Left Stacks Path === Right Stacks Path (MUST)
      - ${this.stacksPathFinal}:${this.stacksPathFinal}
    environment:
      # Tell Dockge where to find the stacks
      - DOCKGE_STACKS_DIR=${this.stacksPathFinal}`;
            },
            composeYAMLHighlighted() {
                return Prism.highlight(this.composeYAML, Prism.languages.yaml, 'yaml');
            }
        },
        mounted() {
        }
    }).mount('#app')
</script>
</body>
</html>
