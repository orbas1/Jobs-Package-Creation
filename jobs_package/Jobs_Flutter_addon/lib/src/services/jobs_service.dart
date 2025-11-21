import 'package:collection/collection.dart';

import '../models/job.dart';
import '../models/company.dart';
import '../models/screening.dart';
import 'api_client.dart';

class JobsService {
  JobsService(this.client);

  final JobsApiClient client;

  Future<List<Job>> fetchJobs({String? keyword, String? location}) async {
    final payload = await client.getJson('/api/jobs', query: {
      if (keyword?.isNotEmpty == true) 'q': keyword!,
      if (location?.isNotEmpty == true) 'location': location!,
    });
    final jobs = payload['data'] as List<dynamic>? ?? [];
    return jobs.map((e) => Job.fromJson(e as Map<String, dynamic>)).toList();
  }

  Future<Job> fetchJob(int id) async {
    final payload = await client.getJson('/api/jobs/$id');
    return Job.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<List<Job>> fetchSavedJobs() async {
    final payload = await client.getJson('/api/jobs/saved');
    return (payload['data'] as List<dynamic>? ?? [])
        .map((e) => Job.fromJson(e as Map<String, dynamic>))
        .toList();
  }

  Future<void> toggleSave(int jobId, bool saved) async {
    await client.postJson('/api/jobs/$jobId/save', body: {'saved': saved});
  }

  Future<List<Job>> fetchSimilar(Job job) async {
    final payload = await client.getJson('/api/jobs/${job.id}/similar');
    return (payload['data'] as List<dynamic>? ?? [])
        .map((e) => Job.fromJson(e as Map<String, dynamic>))
        .toList();
  }

  Future<List<Company>> fetchRecommendedCompanies() async {
    final payload = await client.getJson('/api/jobs/recommended-companies');
    return (payload['data'] as List<dynamic>? ?? [])
        .map((e) => Company.fromJson(e as Map<String, dynamic>))
        .toList();
  }

  Future<List<ScreeningQuestion>> fetchScreeningQuestions(int jobId) async {
    final payload = await client.getJson('/api/jobs/$jobId/screening');
    final questions = payload['data'] as List<dynamic>? ?? [];
    return questions
        .map((e) => ScreeningQuestion.fromJson(e as Map<String, dynamic>))
        .toList();
  }
}
