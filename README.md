# ACAT Keycloak Bundle

Symfony 8 Integration für Keycloak OIDC.

## Voraussetzungen

- PHP 8.5+
- Symfony 8.0+
- `web-token/jwt-library`
- `symfony/http-client`

## Installation

Lokales Repository in `composer.json` einbinden:

```json
"repositories": [
    {
        "type": "path",
        "url": "../path-to-bundle/KeycloakBundle"
    }
],
"require": {
    "acat/keycloak-bundle": "@dev"
}
```

## Konfiguration

### 1. Umgebungsvariablen (.env)

```env
ACAT_KEYCLOAK_AUDIENCE=<client-id>
ACAT_KEYCLOAK_ISSUER=<issuer-url>
KEYCLOAK_SERVER_URL=<server-base-url>
```

### 2. Bundle-Einstellung (config/packages/acat_keycloak.yaml)

```yaml
acat_keycloak:
    identifier_claim: 'sub'
```

### 3. Security (config/packages/security.yaml)

```yaml
security:
    providers:
        acat_keycloak_provider:
            id: ACAT\KeycloakBundle\Security\KeycloakProvider

    firewalls:
        api:
            pattern: ^/api
            stateless: true
            provider: acat_keycloak_provider
            access_token:
                token_handler:
                    oidc:
                        algorithms: [ 'RS256' ]
                        audience: '%env(ACAT_KEYCLOAK_AUDIENCE)%'
                        issuers:
                            - '%env(ACAT_KEYCLOAK_ISSUER)%'
                        discovery:
                            base_uri: '%env(KEYCLOAK_SERVER_URL)%/'
                            cache:
                                id: cache.app
```

## Fehlerbehebung

- **404 Discovery**: `KEYCLOAK_SERVER_URL` prüfen. Der Slash am Ende der `base_uri` ist zwingend erforderlich.
- **Invalid Audience**: `ACAT_KEYCLOAK_AUDIENCE` muss exakt der Keycloak Client-ID entsprechen.
- **Unsupported Format**: Header `Content-Type: application/json` im API-Request erforderlich.

## Lizenz

Proprietär
