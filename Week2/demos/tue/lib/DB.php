print.metrics"/>
      </table>

      <xsl:call-template name="pageFooter"/>
    </BODY>
  </HTML>
</xsl:template>


<!-- list of classes in a package -->
<xsl:template match="package" mode="classes.list">
  <HTML>
    <HEAD>
      <xsl:call-template name="create.stylesheet.link">
        <xsl:with-param name="package.name" select="@name"/>
      </xsl:call-template>
    </HEAD>
    <BODY>
      <table width="100%">
        <tr>
          <td nowrap="nowrap">
            <H2><a href="package-summary.html" target="classFrame"><xsl:value-of select="@name"/></a></H2>
          </td>
        </tr>
      </table>

      <H2>Classes</H2>
      <TABLE WIDTH="100%">
        <!-- xalan-nodeset:nodeset for Xalan 1.2.2 -->
            <xsl:for-each select="$doctree/classes/class[@package = current()/@name]">
                <xsl:sort select="@name"/>
          <tr>
            <td nowrap="nowrap">
              <a href="{@name}.html" target="classFrame"><xsl:value-of select="@name"/></a>
            </td>
          </tr>
            </xsl:for-each>
      </TABLE>
    </BODY>
  </HTML>
</xsl:template>


<!--
  Creates an all-classes.html file that contains a link to all package-summary.html
  on each class.
-->
<xsl:template match="metrics" mode="all.classes">
  <html>
    <head>
      <xsl:call-template name="create.stylesheet.link">
        <xsl:with-param name=