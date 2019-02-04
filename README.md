# JIRA Workflow tasks

This project allows to you create a workflow template to build tasks in Jira. You only need to set the specifications in multiples YML files, and then the script will generate the tasks and their relationships accordingly the YML configuration.

## Requirements

This project uses two libraries:

- [PHP Jira Rest Client](https://github.com/lesstif/php-jira-rest-client)
- [Symfony YAML](https://symfony.com/doc/current/components/yaml.html)

This libraries are already loaded with composer

## Getting Started

To get started it's necessary set some environment variables. You need to copy the `.env.example` file as .env file.

Here set the JIRA properties:

```
JIRA_HOST="https://your-jira.host.com"
JIRA_USER="jira-username"
JIRA_PASS="jira-password-OR-api-token"
```

### Installing

Firts install composer to get the libraries installed.

```
composer install
```

Now it's necessary set the templates

### Templates

The project already becomes with a example template. The templates are stored in the folder templates.

*Template Folder*

To get a project working you can copy and paste the structure of `templates/example` or create your own.
First create a folder inside `templates`, the name of the folder it's going to be the name of your template. In our case it's "example".

Now create a [config.yml](https://github.com/diegonalvarez/jira-workflow-tasks/blob/master/templates/example/config.yml) file.
This file has basic information about the project and the files path to detect the configuration.

*Users*

Now create a [users.yml](https://github.com/diegonalvarez/jira-workflow-tasks/blob/master/templates/example/users/users.yml), our location it's `templates/example/users/users.yml`.

Here you can store the references for the users of your JIRA APP.

*Epic Tasks*

Create a [epic.yml](https://github.com/diegonalvarez/jira-workflow-tasks/blob/master/templates/example/tasks/epic/epic.yml), our location it's `templates/example/tasks/epic/epic.yml`.

This file it's to set the basic information about our epic task.

*Tasks*

Create a [tasks.yml](https://github.com/diegonalvarez/jira-workflow-tasks/blob/master/templates/example/tasks/task/tasks.yml), our location it's `templates/example/tasks/task/tasks.yml`.

This file it's to set the path of every main TASK that are going to be realted to the epic.

*Task Sub-Tasks Relations*

Create a file in `templates/example/tasks/task/taskname.yml`. [taskname.yml](https://github.com/diegonalvarez/jira-workflow-tasks/blob/master/templates/example/tasks/task/customer.yml), our location it's `templates/example/tasks/task/taskname.yml`. For this example you can see the file https://github.com/diegonalvarez/jira-workflow-tasks/blob/master/templates/example/tasks/task/customer.yml.

This file have the information about the task and their sub-task that are going to be created.

*Relations*

To be implemented

## Running the tests

To run the test simple use:

```
vendor/bin/phpunit test/unit
```

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Alvarez Diego** - *Initial work*

See also the list of [contributors](https://github.com/diegonalvarez/jira-workflow-tasks/graphs/contributors) who participated in this project.

## License

This project is licensed under the APACHE-2.0 License - see the [LICENSE.md](LICENSE.md) file for details
