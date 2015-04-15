to more classes with individually higher cohesion. On the other
hand, a high value of cohesion (a low lack of cohesion) implies that the
class is well designed. A cohesive class will tend to provide a high degree
of encapsulation, whereas a lack of cohesion decreases encapsulation and
increases complexity.
<p/>
Another form of cohesion that is useful for Java programs is cohesion
between nested and enclosing classes. A nested class that has very low
cohesion with its enclosing class would probably better designed as a peer
class rather than a nested class.
<p/>
LCOM is defined for classes. Operationally, LCOM takes each pair of
methods in the class and determines the set of fields they each access. If
they have disjoint sets of field accesses increase the count P by one. If they
share at least one field access then increase Q by one. After considering
each pair of methods,
LCOM = (P > Q) ? (P - Q) : 0
<p/>
Indirect access to fields via local methods can be considered by setting a
metric configuration parameter.

<a name="NOC"/>
<h3>Number Of Classes - NOC</h3>

The overall size of the system can be estimated by calculating the number
of classes it contains. A large system with more classes is more complex
than a smaller one because the number of potential interactions between
objects is higher. This reduces the comprehensibility of the system which
in turn makes it harder to test, debug and maintain.
<p/>
If the number of classes in the system can be projected during the initial
design phase of the project it can serve as a base for estimating the total
effort and cost of developing, debugging and maintaining the system.
<p/>
The NOC metric can also usefully be applied at the package and class level
as well as the total system.
<p/>
NOCL is defined for class and interfaces. It counts the number of classes or
interfaces that are declared. This is usually 1, but nested class declarations
will increase this number.
</body>
</html>
</xsl:template>

<!-- this is the stylesheet css to use for nearly everything -->
<xsl:template name="stylesheet.css">
    .bannercell {
      border: 0px;
      padding: 0px;
    }
    body {
      margin-left: 10;
      margin-right: 10;
      font:normal 80% arial,helvetica,sanserif;
      background-color:#FFFFFF;
      color:#000000;
    }
    .a td {
      background: #efefef;
    }
    .b td {
      background: #fff;
    }
    th, td {
      text-align: left;
      vertical-align: top;
    }
    th {
      font-weight:bold;
      background: #ccc;
      color: black;
    }
    table, th, td {
      font-size:100%;
      border: none
    }
    table.log tr td, tr th {

    }
    h2 {
      font-weight:bold;
      font-size:140%;
      margin-bottom: 5;
    }
    h3 {
      font-size:100%;
      font-weight:bold;
      background: #525D76;
      color: white;
      text-decoration: none;
      padding: 5px;
      margin-right: 2px;
      margin-left: 2px;
      margin-bottom: 0;
    }
    .Error {
      font-weight:bold; color:red;
    }

</xsl:template>

<!-- print the metrics of the class -->
<xsl:template match="class" mode="class.details">
  <!--xsl:variable name="package.name" select="(ancestor::package)[last()]/@name"/-->
  <xsl:variable name="package.name" select="@package"/>
  <HTML>
    <HEAD>
      <xsl:call-template name="create.stylesheet.link">
        <xsl:with-param name="package.name" s