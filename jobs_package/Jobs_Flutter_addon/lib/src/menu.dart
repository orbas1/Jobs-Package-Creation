import 'package:flutter/material.dart';

import 'widgets/screens.dart';
import 'api/api_client.dart';
import 'data/jobs_repository.dart';
import 'data/profile_repository.dart';
import 'data/subscription_repository.dart';

/// Menu helper that wires the jobs addon into a tab or drawer structure.
class JobsMenuBuilder {
  JobsMenuBuilder({required this.baseUrl, this.headers});

  final String baseUrl;
  final Map<String, String>? headers;

  List<Widget> buildScreens() {
    final client = JobsApiClient(baseUrl: baseUrl, defaultHeaders: headers);
    final jobsRepo = JobsRepository(client);
    final profileRepo = ProfileRepository(client);
    final subscriptionRepo = SubscriptionRepository(client);

    return <Widget>[
      JobListScreen(repository: jobsRepo),
      SubscriptionScreen(repository: subscriptionRepo),
      CvBuilderPage(profileRepository: profileRepo, candidateId: 0),
    ];
  }
}
