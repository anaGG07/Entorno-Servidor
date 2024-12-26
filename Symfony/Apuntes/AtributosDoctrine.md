## Índice 📑
- [Atributos de Doctrine](#atributos-de-doctrine)
    - [**¿Qué es Doctrine?**](#qué-es-doctrine)
  - [#\[ORM\\Id\]](#ormid)
  - [#\[ORM\\GeneratedValue\]](#ormgeneratedvalue)
  - [#\[ORM\\Column\]](#ormcolumn)
  - [#\[ORM\\OneToMany\]](#ormonetomany)
  - [#\[ORM\\ManyToOne\]](#ormmanytoone)
  - [#\[ORM\\JoinColumn\]](#ormjoincolumn)
  - [#\[ORM\\OneToOne\]](#ormonetoone)
  - [#\[ORM\\ManyToMany\]](#ormmanytomany)
  - [#\[ORM\\Index\]](#ormindex)
  - [#\[ORM\\UniqueConstraint\]](#ormuniqueconstraint)
  - [#\[ORM\\Table\]](#ormtable)
  - [#\[ORM\\Embeddable\]](#ormembeddable)
  - [#\[ORM\\Embedded\]](#ormembedded)


# Atributos de Doctrine

### **¿Qué es Doctrine?**
Doctrine ORM es una herramienta que permite mapear entidades de PHP (clases y objetos) a tablas de bases de datos relacionales, gestionando automáticamente las relaciones, las consultas y las operaciones CRUD.

Desde Doctrine ORM 2.9, se introdujeron atributos PHP como una alternativa moderna a las tradicionales anotaciones de Doctrine (comentarios con @ en PHPDoc). Estos atributos usan la sintaxis moderna de PHP (con #[...]) y ofrecen las mismas capacidades que las anotaciones anteriores.


## #[ORM\Id]
- Declara que el campo es la clave primaria de la tabla asociada a la entidad.
- **Ejemplo**:
  ```php
  #[ORM\Id]
  #[ORM\Column(type: "integer")]
  #[ORM\GeneratedValue]
  private int $id;
  ```

## #[ORM\GeneratedValue]
- Indica que el valor del campo será generado automáticamente por la base de datos (generalmente usado con claves primarias incrementales).
- **Ejemplo**:
  ```php
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: "integer")]
  private int $id;
  ```

## #[ORM\Column]
- Define una columna en la base de datos.
- Atributos:
  - **type**: Define el tipo de datos.
  - **length**: Longitud máxima (solo aplica para tipos como string).
  - **nullable**: Permite valores nulos.
  - **unique**: Define que el valor debe ser único.
- Tipos comunes:
  - **integer**: Números enteros.
  - **string**: Cadena de texto.
  - **boolean**: Verdadero o falso.
  - **decimal**: Números decimales con precisión y escala.
  - **datetime**: Fechas y horas.
- **Ejemplos**:
  ```php
  #[ORM\Column(type: "string", length: 100)]
  private string $nombre;

  #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
  private float $precio;

  #[ORM\Column(type: "boolean", nullable: true)]
  private ?bool $activo = null;
  ```

## #[ORM\OneToMany]
- Declara una relación de uno a muchos con otra entidad.
- Atributos:
  - **mappedBy**: Campo en la otra entidad que mapea esta relación.
- **Ejemplo**:
  ```php
  #[ORM\OneToMany(mappedBy: "categoria", targetEntity: Producto::class)]
  private Collection $productos;
  ```

## #[ORM\ManyToOne]
- Declara una relación de muchos a uno con otra entidad.
- Atributos:
  - **targetEntity**: Clase de la entidad relacionada.
  - **inversedBy**: Campo en la otra entidad que representa esta relación.
- **Ejemplo**:
  ```php
  #[ORM\ManyToOne(targetEntity: Categoria::class, inversedBy: "productos")]
  #[ORM\JoinColumn(name: "categoria_id", referencedColumnName: "id", nullable: false)]
  private Categoria $categoria;
  ```

## #[ORM\JoinColumn]
- Define la columna de unión en una relación.
- Atributos:
  - **name**: Nombre de la columna.
  - **referencedColumnName**: Campo en la entidad relacionada.
  - **nullable**: Si la columna acepta valores nulos.
- **Ejemplo**:
  ```php
  #[ORM\JoinColumn(name: "categoria_id", referencedColumnName: "id", nullable: false)]
  private Categoria $categoria;
  ```

## #[ORM\OneToOne]
- Declara una relación de uno a uno con otra entidad.
- Atributos:
  - **targetEntity**: Clase de la entidad relacionada.
  - **mappedBy**: Campo en la otra entidad que mapea esta relación.
- **Ejemplo**:
  ```php
  #[ORM\OneToOne(mappedBy: "perfil", targetEntity: Usuario::class)]
  private Usuario $usuario;
  ```

## #[ORM\ManyToMany]
- Declara una relación de muchos a muchos con otra entidad.
- Atributos:
  - **targetEntity**: Clase de la entidad relacionada.
  - **inversedBy**: Campo en la otra entidad que mapea esta relación.
  - **JoinTable**: Define la tabla intermedia.
- **Ejemplo**:
  ```php
  #[ORM\ManyToMany(targetEntity: Rol::class, inversedBy: "usuarios")]
  #[ORM\JoinTable(name: "usuarios_roles")]
  private Collection $roles;
  ```

## #[ORM\Index]
- Define un índice en una o más columnas.
- Atributos:
  - **columns**: Columnas incluidas en el índice.
  - **name**: Nombre del índice.
- **Ejemplo**:
  ```php
  #[ORM\Index(columns: ["email"], name: "idx_usuario_email")]
  ```

## #[ORM\UniqueConstraint]
- Define una restricción de unicidad en una o varias columnas.
- Atributos:
  - **columns**: Lista de columnas que forman la restricción.
- **Ejemplo**:
  ```php
  #[ORM\UniqueConstraint(columns: ["email"])]
  ```

## #[ORM\Table]
- Declara una tabla de base de datos personalizada para una entidad.
- Atributos:
  - **name**: Nombre de la tabla.
  - **indexes**: Define índices para la tabla.
  - **uniqueConstraints**: Define restricciones de unicidad.
- **Ejemplo**:
  ```php
  #[ORM\Table(name: "usuarios", indexes: [#[ORM\Index(columns: ["email"], name: "idx_email")]])]
  ```

## #[ORM\Embeddable]
- Define una clase que puede ser reutilizada como un objeto incrustado dentro de otra entidad.
- **Ejemplo**:
  ```php
  #[ORM\Embeddable]
  class Direccion {
      #[ORM\Column(type: "string", length: 255)]
      private string $calle;

      #[ORM\Column(type: "string", length: 100)]
      private string $ciudad;
  }
  ```

## #[ORM\Embedded]
- Permite incluir una clase embeddable dentro de una entidad.
- **Ejemplo**:
  ```php
  #[ORM\Embedded(class: Direccion::class)]
  private Direccion $direccion;
  ```
