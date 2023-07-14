
## API Reference

## Endpoint

### GET /locations/nearby

This endpoint returns a list of locations within a specified radius of a given latitude and longitude.

#### Parameters

| Name       | Type    | Description                                                                   |
|------------|---------|-------------------------------------------------------------------------------|
| latitude   | float   | The latitude of the center point (required).                                  |
| longitude  | float   | The longitude of the center point (required).                                 |
| radius     | integer | The radius (in kilometers) within which to find locations (required).         |

#### Response

The response is a JSON object containing an array of locations. Each location is represented as an object with the following properties:

| Name       | Type    | Description                                       |
|------------|---------|---------------------------------------------------|
| name       | string  | The name of the location.                         |
| latitude   | float   | The latitude of the location.                     |
| longitude  | float   | The longitude of the location.                    |

#### Example Request 

POST /locations/nearby?latitude=51.509865&longitude=-0.118092&radius=10


#### Example Response

```json
[
    {
        "name": "Location 1",
        "latitude": 51.509865,
        "longitude": -0.118092
    },
    {
        "name": "Location 2",
        "latitude": 51.509865,
        "longitude": -0.118092
    }
]
```

### Example error when there is no response

```json
{
    "errors": {
        "latitude": [
            "The latitude field is required."
        ],
        "longitude": [
            "The longitude field is required."
        ],
        "radius": [
            "The radius field is required."
        ]
    }
}

```


