# MongoDB Aggregation Pipelines

## Pàgines més visitades
Agrupa els logs per URL i compta quantes vegades s'ha visitat cada una.
Ordena de més a menys visites i limita a 10 resultats.

## Usuaris més actius
Agrupa els logs per usuari (excloent els null) i compta els seus accessos.
Ordena de més a menys accessos i limita a 10 resultats.

## Accessos per dia
Agrupa els logs per dia usant dateToString per formatar el timestamp.
Ordena cronològicament per veure la tendència d'ús.