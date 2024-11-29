<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" encoding="UTF-8" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Catálogo VOD</title>
                <!-- Bootstrap CDN -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
                <style type="text/css">
                    body {
                        background-color: #1e293b; /* Azul oscuro */
                        color: #f8fafc; /* Blanco humo */
                        font-family: 'Roboto', Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    header {
                        text-align: center;
                        background: linear-gradient(135deg, #0ea5e9, #3b82f6); /* Degradado azul */
                        padding: 20px 0;
                        border-bottom: 4px solid #52524c; /* Azul grisáceo */
                    }
                    #logo {
                        display: block;
                        margin: 20px auto;
                        width: 150px;
                        height: auto;
                        border-radius: 50%;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
                        transition: transform 0.3s ease-in-out;
                    }
                    #logo:hover {
                        transform: scale(1.1);
                    }
                    h1 {
                        color: #ffffff;
                        font-size: 3.5em;
                        font-weight: bold;
                        margin-bottom: 40px;
                    }
                    h2 {
                        color: #ffffff;
                        margin: 20px 0;
                        text-transform: uppercase;
                        font-weight: bold;
                        padding-bottom: 5px;
                        border-bottom: 3px solid #0ea5e9;
                        display: inline-block;
                    }
                    .container {
                        padding: 40px;
                        max-width: 1200px;
                        margin: auto;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 20px 0;
                        overflow: hidden;
                        border-radius: 8px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
                        border: 2px solid #3b82f6; /* Azul vivo */
                    }
                    table thead {
                        background-color: #1e40af; /* Azul oscuro intenso */
                        color: #ffffff;
                    }
                    table th, table td {
                        padding: 15px;
                        text-align: center;
                        border: 1px solid #334155; /* Gris azulado */
                    }
                    table tbody tr:nth-child(even) {
                        background-color: rgba(59, 130, 246, 0.1); /* Azul claro translúcido */
                    }
                    table tbody tr:hover {
                        background-color: rgba(14, 165, 233, 0.2); /* Azul brillante translúcido */
                        transition: 0.3s ease-in-out;
                    }
                </style>
            </head>
            <header>
                <img src="logo.jpg" alt="Logotipo" id="logo"/>
                <h1>Cátalogo Xanaks</h1>
            </header>
            <body>
                <div class="container">
                    <h2>Películas</h2>
                    <xsl:for-each select="catalogovod/contenido/peliculas">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Duración</th>
                                    <th>Género</th>
                                </tr>
                            </thead>
                            <tbody>
                                <xsl:for-each select="genero">
                                    <xsl:variable name="generoNombre" select="@nombre"/>
                                    <xsl:for-each select="titulo">
                                        <tr>
                                            <td><xsl:value-of select="."/></td>
                                            <td><xsl:value-of select="@duracion"/></td>
                                            <td><xsl:value-of select="$generoNombre"/></td>
                                        </tr>
                                    </xsl:for-each>
                                </xsl:for-each>
                            </tbody>
                        </table>
                    </xsl:for-each>

                    <h2>Series</h2>
                    <xsl:for-each select="catalogovod/contenido/series">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Duración</th>
                                    <th>Género</th>
                                </tr>
                            </thead>
                            <tbody>
                                <xsl:for-each select="genero">
                                    <xsl:variable name="generoNombre" select="@nombre"/> 
                                    <xsl:for-each select="titulo">
                                        <tr>
                                            <td><xsl:value-of select="."/></td>
                                            <td><xsl:value-of select="@duracion"/></td>
                                            <td><xsl:value-of select="$generoNombre"/></td>
                                        </tr>
                                    </xsl:for-each>
                                </xsl:for-each>
                            </tbody>
                        </table>
                    </xsl:for-each>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
