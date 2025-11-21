import '../models/application.dart';
import '../models/ats.dart';
import '../models/interview.dart';
import 'api_client.dart';

class ApplicationsService {
  ApplicationsService(this.client);

  final JobsApiClient client;

  Future<List<JobApplication>> fetchApplications() async {
    final payload = await client.getJson('/api/applications');
    return (payload['data'] as List<dynamic>? ?? [])
        .map((e) => JobApplication.fromJson(e as Map<String, dynamic>))
        .toList();
  }

  Future<JobApplication> fetchApplication(int id) async {
    final payload = await client.getJson('/api/applications/$id');
    return JobApplication.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<void> submitApplication(Map<String, dynamic> body) async {
    await client.postJson('/api/applications', body: body);
  }

  Future<void> withdraw(int id) async {
    await client.postJson('/api/applications/$id/withdraw');
  }

  Future<List<InterviewInvite>> fetchInterviews(int applicationId) async {
    final payload = await client.getJson('/api/applications/$applicationId/interviews');
    return (payload['data'] as List<dynamic>? ?? [])
        .map((e) => InterviewInvite.fromJson(e as Map<String, dynamic>))
        .toList();
  }

  Future<void> moveStage(int applicationId, AtsStage stage) async {
    await client.putJson('/api/applications/$applicationId/stage', body: stage.toJson());
  }
}
