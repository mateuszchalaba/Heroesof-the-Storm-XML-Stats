<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:param name="sortKey">title</xsl:param>
<xsl:param name="sortOrder">ascending</xsl:param>
<xsl:param name="sortType">text</xsl:param>

<xsl:template match="/">
    <table class="table table-bordered table-striped" >
        <tr>
			 <th width="45px"></th>
            <th><a href="JavaScript:reSort('nazwa');">Nazwa </a><xsl:call-template name="hdr"><xsl:with-param name="header" select="'nazwa'" /></xsl:call-template></th>
            <th><a href="JavaScript:reSort('typ');">Typ </a><xsl:call-template name="hdr"><xsl:with-param name="header" select="'typ'" /></xsl:call-template></th>
            <th><a href="JavaScript:reSort('uniwersum');">Uniwersum </a><xsl:call-template name="hdr"><xsl:with-param name="header" select="'uniwersum'" /></xsl:call-template></th>
           
            <th><a href="JavaScript:reSort('zwyciestwa');">Zwyciestwa </a><xsl:call-template name="hdr"><xsl:with-param name="header" select="'zwyciestwa'" /></xsl:call-template></th>
            <th><a href="JavaScript:reSort('popularnosc');">Popularnosc </a><xsl:call-template name="hdr"><xsl:with-param name="header" select="'popularnosc'" /></xsl:call-template></th>		 
        </tr>
    <xsl:for-each select="postacie/postac">
    <xsl:sort select="*[name(.)=$sortKey]|@*[name(.)=$sortKey]" order="{$sortOrder}" data-type="{$sortType}" />
        <tr>	

			<td id="mini"><img width="40px" height="40px" src="{miniatura}" /></td>
            <td><b id="opislink" onclick="alert('{opis}');"><xsl:value-of select="nazwa"/></b></td>
				
            <td><xsl:value-of select="typ"/></td>
            <td><xsl:value-of select="uniwersum"/></td>
			
            <td class="numeric"><xsl:value-of select="format-number(zwyciestwa, '###.#')"/>%</td>
            <td class="numeric"><xsl:value-of select="format-number(popularnosc, '###.#')"/>%</td>
		
        </tr>
    </xsl:for-each>
    </table>
</xsl:template>

<xsl:template name="hdr">
<xsl:param name="header" />			
    <xsl:if test="$sortKey = $header">
        <xsl:if test="$sortOrder = 'ascending'"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></xsl:if>
        <xsl:if test="$sortOrder = 'descending'"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></xsl:if>
    </xsl:if>
    <xsl:if test="$sortKey != $header"><img class="nosort" src="null.gif" /></xsl:if>
</xsl:template>
<xsl:decimal-format name="currency" decimal-separator="." grouping-separator=","/>

</xsl:stylesheet>