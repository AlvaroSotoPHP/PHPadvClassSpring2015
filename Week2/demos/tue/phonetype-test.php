  Methods from class files are given a V(G) of 1.</li>
<li>the arity, or the number of parameters of the method are used to
   determine the weight.</li>
</ul>

<a name="RFC"/>
<h3>Response For Class - RFC</h3>

The response set of a class is the set of all methods that can be invoked as
a result of a message sent to an object of the class. This includes methods
in the class's inheritance hierarchy and methods that can be invoked on
other objects. The Response For Class metric is defined to be size of the
response set for the class. A class which provides a larger response set is
considered to be more complex than one with a smaller response set.
<p/>
One reason for this is that if a method call on a class can result in a large
number of different method calls on the target and other classes, then it
can be harder to test the behavior of the class and debug problems. It will
typically require a deeper understanding of the potential interactions that
objects of the class can have with the rest of the system.
<p/>
RFC is defined as the sum of NLM and NRM for the class.  The local methods
include all of the public, protected, package and private methods, but not
methods declared only in a superclass.

<a name="DAC"/>
<h3>Data Abstraction Coupling - DAC</h3>

DAC is defined for classes and interfaces.  It counts the number of reference
types that are used in the field declarations of the class or interface.  The
component types of arrays are also counted.  Any field with a type that is
either a supertype or a subtype of the class is not counted.

<a name="FANOUT"/>
<h3>Fan Out - FANOUT</h3>

FANOUT is defined for classes and interfaces, constructors and methods. It
counts the number of reference types that are used in:
<ul>
<li>field declarations;</li>
<li>formal parameters and return types;</li>
<li>throws declarations;</li>
<li>local variables.</li>
</ul>

The component types of arrays are also counted. Any type that is either a
supertype or a subtype of the class is not counted.

<a name="CBO"/>
<h3>Coupling Between Objects - CBO</h3>

When one object or class uses another object or class they are said to be
coupled. One major source of coupling is that between a superclass and a
subclass. A coupling is also introduced when a method or field in another
class is accessed, or when an object of another class is passed into or out
of a method invocation. Coupling Between Objects is a measure of the
non-inheritance coupling between two objects.
<p/>
A high value of coupling reduces the modularity of the class and makes
reuse more difficult. The more independent a class is the more likely it is
that it will be possible to reuse it in another part of the system. When a
class is coupled to another class it becomes sensitive to changes in that
class, thereby making maintenance for difficult. In addition, a class that is
overly dependent on other classes can be difficult to understand and test in
isolation.
<p/>
CBO is define