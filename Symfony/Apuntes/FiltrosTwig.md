---
title: "Filtros Twig"
author: "Ana María García"
date: "2024-12-26"
---



## Índice
- [Transformación de cadenas](#transformación-de-cadenas)
- [Formato de números](#formato-de-números)
- [Fechas](#fechas)
- [Manipulación de cadenas](#manipulación-de-cadenas)
- [Manipulación de listas](#manipulación-de-listas)
- [JSON y datos](#json-y-datos)
- [Condicionales y predeterminados](#condicionales-y-predeterminados)
- [Operaciones matemáticas](#operaciones-matemáticas)
- [Otros filtros](#otros-filtros)
- [Funciones avanzadas](#funciones-avanzadas)

---
# Filtros Twig 🎨

- **Transformación de cadenas** ✍️
  - `upper`: Convierte una cadena a mayúsculas.
    ```twig
    {{ 'hola mundo'|upper }} {# Resultado: HOLA MUNDO #}
    ```
  - `lower`: Convierte una cadena a minúsculas.
    ```twig
    {{ 'HOLA MUNDO'|lower }} {# Resultado: hola mundo #}
    ```
  - `capitalize`: Convierte el primer carácter de la cadena a mayúscula.
    ```twig
    {{ 'hola mundo'|capitalize }} {# Resultado: Hola mundo #}
    ```
  - `title`: Convierte cada palabra de una cadena a título.
    ```twig
    {{ 'hola mundo'|title }} {# Resultado: Hola Mundo #}
    ```

- **Formato de números** 🔢
  - `number_format`: Formatea números con decimales y separadores personalizados.
    ```twig
    {{ 1234.5678|number_format(2, '.', ',') }} {# Resultado: 1,234.57 #}
    ```

- **Fechas** 📅
  - `date`: Convierte una fecha a un formato específico.
    ```twig
    {{ '2024-01-01'|date('d/m/Y') }} {# Resultado: 01/01/2024 #}
    ```
  - `date_modify`: Modifica una fecha con un intervalo.
    ```twig
    {{ 'now'|date_modify('+1 day')|date('Y-m-d') }} {# Resultado: fecha de mañana #}
    ```

- **Manipulación de cadenas** ✂️
  - `replace`: Reemplaza partes de una cadena.
    ```twig
    {{ 'Hola Mundo'|replace({'Mundo': 'Twig'}) }} {# Resultado: Hola Twig #}
    ```
  - `truncate`: Corta una cadena si excede un límite.
    ```twig
    {{ 'Este es un texto muy largo'|truncate(10) }} {# Resultado: Este es... #}
    ```
  - `striptags`: Elimina etiquetas HTML de una cadena.
    ```twig
    {{ '<b>Hola</b> Mundo'|striptags }} {# Resultado: Hola Mundo #}
    ```
  - `trim`: Elimina espacios en blanco de los extremos de una cadena.
    ```twig
    {{ '  hola  '|trim }} {# Resultado: hola #}
    ```
  - `split`: Divide una cadena en partes.
    ```twig
    {{ 'hola mundo'|split(' ') }} {# Resultado: ['hola', 'mundo'] #}
    ```

- **Manipulación de listas** 📋
  - `length`: Devuelve la longitud de una lista o cadena.
    ```twig
    {{ 'hola'|length }} {# Resultado: 4 #}
    {{ [1, 2, 3]|length }} {# Resultado: 3 #}
    ```
  - `first`: Devuelve el primer elemento de una lista.
    ```twig
    {{ [1, 2, 3]|first }} {# Resultado: 1 #}
    ```
  - `last`: Devuelve el último elemento de una lista.
    ```twig
    {{ [1, 2, 3]|last }} {# Resultado: 3 #}
    ```
  - `reverse`: Invierte el orden de una lista o cadena.
    ```twig
    {{ 'Hola'|reverse }} {# Resultado: aloH #}
    {{ [1, 2, 3]|reverse }} {# Resultado: [3, 2, 1] #}
    ```
  - `merge`: Combina dos listas en una sola.
    ```twig
    {{ [1, 2]|merge([3, 4]) }} {# Resultado: [1, 2, 3, 4] #}
    ```
  - `batch`: Divide una lista en grupos más pequeños.
    ```twig
    {% for group in items|batch(3) %}
        {{ group }}
    {% endfor %}
    ```

- **JSON y datos** 🗂️
  - `json_encode`: Convierte una variable a formato JSON.
    ```twig
    {{ {name: 'John', age: 30}|json_encode }} {# Resultado: {"name":"John","age":30} #}
    ```
  - `keys`: Obtiene las claves de un array asociativo.
    ```twig
    {{ {a: 1, b: 2}|keys }} {# Resultado: ['a', 'b'] #}
    ```

- **Condicionales y predeterminados** ⚙️
  - `default`: Devuelve un valor por defecto si la variable no está definida o es `null`.
    ```twig
    {{ nombre|default('Sin nombre') }} {# Resultado: Sin nombre si nombre no está definido #}
    ```

- **Operaciones matemáticas** ➕➖
  - `abs`: Devuelve el valor absoluto.
    ```twig
    {{ -5|abs }} {# Resultado: 5 #}
    ```
  - `round`: Redondea un número según las opciones dadas.
    ```twig
    {{ 5.678|round }} {# Resultado: 6 #}
    {{ 5.678|round(2, 'floor') }} {# Resultado: 5.67 #}
    ```

- **Otros filtros** 🔧
  - `e` (alias de `escape`): Escapa caracteres especiales para prevenir inyección de código.
    ```twig
    {{ '<b>Hola</b>'|e }} {# Resultado: &lt;b&gt;Hola&lt;/b&gt; #}
    ```
  - `nl2br`: Convierte saltos de línea en etiquetas `<br>`.
    ```twig
    {{ "Hola\nMundo"|nl2br }} {# Resultado: Hola<br>Mundo #}
    ```

- **Funciones avanzadas** 🧠
  - `filter`: Filtra elementos de una lista según una condición.
    ```twig
    {% for number in numbers|filter(x => x > 10) %}
        {{ number }}
    {% endfor %}
    ```
  - `map`: Aplica una transformación a cada elemento de una lista.
    ```twig
    {{ [1, 2, 3]|map(x => x * 2) }} {# Resultado: [2, 4, 6] #}
    ```
  - `reduce`: Reduce una lista a un solo valor aplicando una operación.
    ```twig
    {{ [1, 2, 3]|reduce((carry, x) => carry + x) }} {# Resultado: 6 #}
    ```
