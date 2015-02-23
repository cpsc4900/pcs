# Model

Contains reusable models.

**Model** The model represents data and the rules that govern access to and updates of this data. In enterprise software, a model often serves as a software approximation of a real-world process.

Or in plain english, models will be injected into the different user's views.  For example, a calendar for the AR user is not, in itself, a "view", it is a model.

When it comes to javascript, we should stick to model generation as: (a) create function(s) to create the model, (b) have the model except a _div_ id so the model knows where to put itself.

For php this is not really needed since we can do a direct "include" within the HTML files.

