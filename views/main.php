<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dockge</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Self-hosted - Docker compose.yaml - Stack-oriented Manager " />
    <link rel="icon" type="image/svg+xml" href="/icon.svg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/main.css?v=2" />
</head>

<body>
<div id="app">
    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-4">
                <div class="mt-3">
                    <img src="/icon.svg" alt="Dockge" class="logo mt-3 mb-3" />

                    <h1>Dockge</h1>

                    <div class="mb-3">
                        Self-hosted - Docker compose.yaml - Stack-oriented Manager
                    </div>

                    <div class="flex mb-3">
                        <a class="btn btn-primary" href="https://github.com/louislam/dockge">GitHub</a>
                    </div>

                </div>
            </div>
            <div class="col p-5">
                <img class="mt-5 screenshot" src="https://github.com/louislam/dockge/assets/1336778/26a583e1-ecb1-4a8d-aedf-76157d714ad7" alt="screenshot" />
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.9/vue.global.prod.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const { createApp, ref } = Vue
    createApp({
        mounted() {

        }
    }).mount('#app')
</script>
</body>
</html>
