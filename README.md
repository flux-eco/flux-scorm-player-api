# FluxScormPlayerApi

## Environment variables

| Variable | Description | Default value |
| -------- | ----------- | ------------- |
| FLUX_SCORM_PLAYER_API_SERVER_HTTPS_CERT | Path to HTTPS certificate file<br>Set this will enable listen on HTTPS<br>Should be on a volume | - |
| FLUX_SCORM_PLAYER_API_SERVER_HTTPS_KEY | Path to HTTPS key file<br>Should be on a volume | - |
| FLUX_SCORM_PLAYER_API_SERVER_LISTEN | Listen IP | 0.0.0.0 |
| FLUX_SCORM_PLAYER_API_SERVER_PORT | Listen port | 9501 |
| FLUX_SCORM_PLAYER_API_SERVER_MAX_UPLOAD_SIZE | Maximal file upload size | 104857600 |
| FLUX_SCORM_PLAYER_API_FILESYSTEM_FOLDER | Scorm directory | /scorm |
| **FLUX_SCORM_PLAYER_API_DATABASE_PASSWORD** | MongoDB password | - |
| FLUX_SCORM_PLAYER_API_DATABASE_HOST | MongoDB host | scorm-player-db |
| FLUX_SCORM_PLAYER_API_DATABASE_PORT | MongoDB port | 27017 |
| FLUX_SCORM_PLAYER_API_DATABASE_USER | MongoDB user name | scorm-player |
| FLUX_SCORM_PLAYER_API_DATABASE_DATABASE | MongoDB database name | scorm-player |
| FLUX_SCORM_PLAYER_API_DATA_STORAGE_TYPE | Data storage type<br>database or external_api | database |
| FLUX_SCORM_PLAYER_API_EXTERNAL_API_GET_DATA_URL | External api data storage get url<br>You can use {scorm_id} and {user_id} placeholders | - |
| FLUX_SCORM_PLAYER_API_EXTERNAL_API_STORE_DATA_URL | External api data storage store url<br>You can use {scorm_id} and {user_id} placeholders | - |
| FLUX_SCORM_PLAYER_API_EXTERNAL_API_DELETE_DATA_URL | External api data storage delete url<br>You can use {scorm_id} placeholder | - |

Minimal variables required to set are **bold**

## Examples

[examples](examples)