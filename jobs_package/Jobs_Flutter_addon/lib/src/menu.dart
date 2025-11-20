import 'package:flutter/material.dart';

import 'widgets/screens.dart';
import 'api/api_client.dart';
import 'data/jobs_repository.dart';
import 'data/profile_repository.dart';
import 'data/subscription_repository.dart';

/// Menu helper that wires the jobs addon into a tab or drawer structure.
class JobsMenuBuilder {
  JobsMenuBuilder({required this.baseUrl});

  final String baseUrl;

  List<Widget> buildScreens() {
    final client = JobsApiClient(baseUrl: baseUrl);
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
